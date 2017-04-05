<?php

namespace App\UserInterface\Courier\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserInterface\Courier\Requests\LoanRequest;
use App\Domain\TransactionRequests;
use App\UserInterface\Courier\Requests\CancelTransactionRequest;
use App\UserInterface\Courier\Requests\ConfirmDeliveredRequest;
use App\UserInterface\Courier\Requests\ConfirmFailedRequest;

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
            $transactionRequests->courierUser_id = Auth::user()->id;
            $transactionRequests->type = TransactionRequests::TYPE_LOAN;
            $transactionRequests->setAccessionNumbers($params['accessionNumber']);
            $transactionRequests->address = $params['bookingAddress'];
            $transactionRequests->bookingSpecifics = $params['bookingSpecifics'];
            $transactionRequests->latitude = $params['lat'];
            $transactionRequests->longitude = $params['lng']; 
            $transactionRequests->remarks = 'Loan Request';
            $transactionRequests->save();

            return redirect()->to('/courier/home');
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
        return redirect()->to('/courier/home');
    }

    public function confirmDelivered(ConfirmDeliveredRequest $request)
    {
        $params = $request->all();
        $transactionRequest = TransactionRequests::where('id', $params['transactionId'])->first();
        if(isset($transactionRequest)) {
            $transactionRequest->confirmDelivered();
            $transactionRequest->save();
        } 
        return redirect()->to('/courier/home');
    }

    public function cancelTransaction(CancelTransactionRequest $request)
    {
        $params = $request->all();
        $transactionRequest = TransactionRequests::where('id', $params['transactionId'])->first();
        if(isset($transactionRequest)) {
            $transactionRequest->cancelTransaction($params['cancelReason']);
            $transactionRequest->save();
        } 
        return redirect()->to('/courier/home');
    }
    
}
