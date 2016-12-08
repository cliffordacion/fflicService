<?php

namespace App\UserInterface\Frontend\Controllers\Auth;

use App\Domain\FrontendUser;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Domain\FrontendUserActivation;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new FrontendUser, as well as the
    | authentication of existing FrontendUser. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect FrontendUser after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'frontend/home';

    /**
     * Where to redirect FrontendUser after logout
     *
     * @var string
     */
    protected $redirectAfterLogout = 'frontend/login';

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
            'email' => 'required|email|max:255|unique:frontend_users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new FrontendUser instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return FrontendUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function authenticated(\Illuminate\Http\Request $request, $user)
    {
        if (!$user->activated) {
            FrontendUserActivation::sendActivationMail($user);
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }
}
