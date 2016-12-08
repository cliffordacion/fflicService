<?php

namespace App\UserInterface\Frontend\Requests;

use App\Http\Requests\Request;

class RegistrationRequest extends Request
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
            'studentId' => 'required|integer|digits_between:5,10|unique:frontend_users,id',
            'name' => 'required|string',   
            'email' => 'required|email|unique:frontend_users,email', 
            'password' => 'required|alpha_num|min:4',
            'password_confirmation' => 'same:password',  
            'course' => 'required|string',        
            'college' => 'required|string',
            'mobileNumber' => 'required|numeric|digits_between:10,12',        
            ];
    }
}
