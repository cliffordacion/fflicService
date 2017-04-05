<?php

namespace App\UserInterface\Courier\Controllers\Auth;

use App\Domain\CourierUser;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Domain\CourierUserActivation;

class AuthController extends Controller
{

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.login';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new CourierUser, as well as the
    | authentication of existing CourierUser. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect CourierUser after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'courier/home';

    /**
     * Where to redirect CourierUser after logout
     *
     * @var string
     */
    protected $redirectAfterLogout = 'courier/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:couriers',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new CourierUser instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return CourierUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function authenticated(\Illuminate\Http\Request $request, $user)
    {
        if (!$user->activated) {
            CourierUserActivation::sendActivationMail($user);
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }
}
