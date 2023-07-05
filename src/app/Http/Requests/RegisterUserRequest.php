<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string name
 * @property string email
 * @property string password
 * @property string avatar
 */
class RegisterUserRequest extends FormRequest
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
            'name' => ['required', 'min:1', 'max:100',  'string'],
            'email' => ['required', 'email', 'max:100', 'string'],
            'password' => ['required', 'min:4',  'max:100', 'string'],
            'avatar' => ['nullable','file', 'mimes:jpeg,png', 'max:2048']
        ];
    }
}
