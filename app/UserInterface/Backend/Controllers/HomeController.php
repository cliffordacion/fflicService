<?php

namespace App\UserInterface\Backend\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\TransactionRequests;

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
    public function index()
    {
        if (\Auth::check()) {
            // The user is logged in...


            $transactionRequests = TransactionRequests::InProgressCollection();
               // dd($transactionRequests);
            // dd($transactionRequests);
            return view('home', ['transactionRequests' => $transactionRequests]);
        }

        return view('welcome');
    }
}
