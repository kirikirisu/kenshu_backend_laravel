<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property string $user_id
 * @property string $title
 * @property string $body
 * @property UploadedFile $thumbnail
 * @property UploadedFile[] $images
 */
class CreatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|string[]|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:100',  'string'],
            'body' => ['required', 'max:1000', 'string'],
            'thumbnail' => ['file', 'mimes:jpeg,png', 'max:2048'],
            'images' => ['required', 'array', 'max:10'],
            'images.*' => ['file', 'mimes:jpeg,png', 'max:2048'],
            'categories' => ['required', 'array', 'max:5'],
            'categories.*' => ['distinct', 'string', 'in:総合,テクノロジー,モバイル,アプリ,エンタメ,ビューティー,ファッション,ライフスタイル,ビジネス,グルメ,スポーツ']
        ];
    }
}
