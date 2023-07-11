<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:100',  'string'],
            'body' => ['required', 'max:1000', 'string'],
            'thumbnail' => ['required', 'max:100', 'string'],
            'images' => ['required', 'array', 'max:10'],
            'images.*' => ['file', 'mimes:jpeg,png', 'max:2048']
        ];
    }
}
