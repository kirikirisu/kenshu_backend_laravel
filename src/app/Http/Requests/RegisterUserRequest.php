<?php declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property UploadedFile $avatar
 */
class RegisterUserRequest extends FormRequest
{
    protected $redirect = '/register';

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

    public function newUser(): User 
    {
       $user = new User();
       $user->name = $this->name;
       $user->email = $this->email;
       $user->password = $this->password;

       return $user;
    }
}
