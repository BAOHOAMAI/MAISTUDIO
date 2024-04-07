<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'title' => 'required|max:255',
            'slug' => 'required',
            'description' => 'required|max:100',
            'duration' => 'required|max:20',
            'episode' => 'required',
            'rated' => 'required',
            'user_rated' => 'required',
            'trailer_title' => 'required',
            'trailer_link' => 'required',
            'genre' => 'required',

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
            'duration'=>'Duration',
            'episode'=>'The episode',
            'rated'=>'The rated',
            'user_rated'=>'The user rate',
            'trailer_title'=>'The trailer title',
            'trailer_link'=>'The trailer link', 
            'genre' => 'Genre',
            'image' => 'Image',
            'image_thumb' => 'image thumb',
        ];
    }
}
