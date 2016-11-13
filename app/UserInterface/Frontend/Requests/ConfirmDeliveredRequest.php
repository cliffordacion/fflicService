<?php

namespace App\UserInterface\Frontend\Requests;

use Auth;
use App\Http\Requests\Request;
use App\Domain\TransactionRequests;

class ConfirmDeliveredRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $requestParam = $this->all();
        return TransactionRequests::where('id', $requestParam['transactionId'])
            ->where('frontendUser_id', Auth::id())->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transactionId' => 'required',      
            ];
    }
}
