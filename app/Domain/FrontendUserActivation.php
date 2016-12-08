<?php
namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class FrontendUserActivation extends Model
{
    // protected $table = 'user_activations';

    public function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public static function createActivation(FrontendUser $user)
    {
        $activation = FrontendUserActivation::where('user_id', $user->id)
                    ->first();

        if (!$activation) {
            $activation = new FrontendUserActivation;
            $token = $activation->getToken();
            $activation->user_id = $user->id;
            $activation->token = $token;
            $activation->save();
        }

        return $activation;
    }

    public function getActivationByToken($token)
    {
        return $this->where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        $this->where('token', $token)->delete();
    }

    public static function sendActivationMail(FrontendUser $user)
    {
        if (!FrontendUserActivation::shouldSend($user)) {
            return;
        }

        $to = $user->email;
        $subject = "Book Delivery Application Activation";

        $activation = FrontendUserActivation::createActivation($user);
        $link = route('user.activate', $activation->token);


        $txt =  sprintf('Activate account <a href="%s">%s</a>', $link, $link);
        $headers = "From: cliffordacion@gmail.com";
        // . "\r\n" . "CC: somebodyelse@example.com";

        $res = mail($to,$subject,$txt,$headers);
        return $res;
    }

    public function activateUser($token)
    {
        $activation = $this->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    public static function shouldSend(FrontendUser $user)
    {
        $isactivated = $user->activated;
        return !$isactivated;
    }
}