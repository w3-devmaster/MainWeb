<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupStoreRequest extends FormRequest
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
            'username' => 'required|max:25',
            'email'    => 'required|email',
            'password' => 'required|max:25',
        ];
    }
}