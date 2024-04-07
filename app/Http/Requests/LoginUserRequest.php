<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login-email' => 'required|email:rfc,dns',
            'login-password' => 'required',
        ];
    }    
    public function messages() {
        return [
            'required'=>'This form is required',
            'max'=>':attribute maximum :max characters',
            'min'=>':attribute must be at least :min characters',
            'email'=>' Invalid email format',
        ];
    }
    public function attributes(){
        return[
            'login-email'=>'Email',
            'login-password'=>'The password',
            ];
    }
}
