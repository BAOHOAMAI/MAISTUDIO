<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => 'required|max:25',
            'slug' => 'required',
            'description' => 'required|max:100',
        ];
    }
    public function messages() {
        return [
            'required'=>'This form is required',
            'max'=>':attribute maximum :max characters',
        ];
    }
    public function attributes(){
        return[
            'title'=>'The title',
            'slug'=>'The slug',
            'description'=>'The description',
        ];
    }
}
