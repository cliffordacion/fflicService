<?php

namespace App\UserInterface\Backend\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\TransactionRequests;

class RequestController extends Controller
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
    public function showRequest($id)
    {
        if (\Auth::check()) {
            // The user is logged in...
            $transactionRequest = TransactionRequests::where('id', $id)->first();
            return view('showRequest', compact('transactionRequest'));
        }

        return view('welcome');
    }
}
