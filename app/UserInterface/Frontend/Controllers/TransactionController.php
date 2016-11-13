<?php

namespace App\UserInterface\Frontend\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserInterface\Frontend\Requests\LoanRequest;
use App\Domain\TransactionRequests;
use App\UserInterface\Frontend\Requests\CancelTransactionRequest;
use App\UserInterface\Frontend\Requests\ConfirmDeliveredRequest;
use App\UserInterface\Frontend\Requests\ConfirmFailedRequest;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function loan(LoanRequest $request)
    {
        if (Auth::user())
        {
            $params = $request->all();
            // dd($params['accessionNumber']);
            $transactionRequests = new TransactionRequests();
            $transactionRequests->frontendUser_id = Auth::user()->id;
            $transactionRequests->type = TransactionRequests::TYPE_LOAN;
            $transactionRequests->setAccessionNumbers($params['accessionNumber']);
            $transactionRequests->address = $params['bookingAddress'];
            $transactionRequests->bookingSpecifics = $params['bookingSpecifics'];
            $transactionRequests->latitude = $params['lat'];
            $transactionRequests->longitude = $params['lng']; 
            $transactionRequests->remarks = 'Loan Request';
            $transactionRequests->save();

            return redirect()->to('/frontend/home');
        }   
    }

    public function confirmFailed(ConfirmFailedRequest $request)
    {
        $params = $request->all();
        $transactionRequest = TransactionRequests::where('id', $params['transactionId'])->first();
        if(isset($transactionRequest)) {
            $transactionRequest->confirmFailed();
            $transactionRequest->save();
        } 
        return redirect()->to('/frontend/home');
    }

    public function confirmDelivered(ConfirmDeliveredRequest $request)
    {
        $params = $request->all();
        $transactionRequest = TransactionRequests::where('id', $params['transactionId'])->first();
        if(isset($transactionRequest)) {
            $transactionRequest->confirmDelivered();
            $transactionRequest->save();
        } 
        return redirect()->to('/frontend/home');
    }

    public function cancelTransaction(CancelTransactionRequest $request)
    {
        $params = $request->all();
        $transactionRequest = TransactionRequests::where('id', $params['transactionId'])->first();
        if(isset($transactionRequest)) {
            $transactionRequest->cancelTransaction($params['cancelReason']);
            $transactionRequest->save();
        } 
        return redirect()->to('/frontend/home');
    }
    
}
