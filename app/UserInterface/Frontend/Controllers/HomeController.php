<?php

namespace App\UserInterface\Frontend\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (\Auth::check()) {
            // The user is logged in...

            $user = \Auth::user(); //Get current user
            if($user->hasCurrentRequest()) {
                $currentRequest = $user->getCurrentRequest();
                return view('requestProgress', ['currentRequest' => $currentRequest]);
            }
            return view('home');
        }
        return view('welcome');
    }
}
