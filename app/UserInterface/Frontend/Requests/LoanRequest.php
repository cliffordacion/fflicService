<?php

namespace App\UserInterface\Frontend\Requests;

use App\Http\Requests\Request;

class LoanRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'accessionNumber.*' => 'required|max:50|distinct',
            'bookingAddress' => 'required|string',   
            'bookingSpecifics' => 'required|string',   
            'lat' => 'required|',        
            'lng' => 'required',        
            ];
    }
}
