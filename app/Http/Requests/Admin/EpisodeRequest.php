<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeRequest extends FormRequest
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
            'episode' => 'required',
            'link-film' => 'required',
        ];
    }
    public function messages() {
        return [
            'required'=>'This form is required',
        ];
    }
    public function attributes(){
        return[
            'episode' => 'Episode',
            'link-film' => 'Episode link',
        ];
    }
}
