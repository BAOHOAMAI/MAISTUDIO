<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|max:18',
            'register-email' => 'required|email',
            'register-password' => 'required|min:8',
            'password-confirm' => 'required|same:register-password',

        ];
    }    
    public function messages() {
        return [
            'required'=>'This form is required',
            'max'=>':attribute maximum :max characters',
            'min'=>':attribute must be at least :min characters',
            'same'=>':attribute does not match',
            'email'=>' Invalid email format',
            'mimes'=>'The file must be an image (jpeg, png, bmp, gif)',
        ];
    }
    public function attributes(){
        return[
            'firstname'=>'Firstname',
            'lastname'=>'Lastname',
            'register-email'=>'Email',
            'phone'=>'Phone',
            'register-password'=>'The password',
            'password-confirm'=>'The password confirmation',
            ];
    }
}
