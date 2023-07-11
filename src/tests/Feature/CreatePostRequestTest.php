<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CreatePostRequestTest extends TestCase
{
    public static function dataProvider(): array
    {
        $title = [
            'タイトルの入力は必須であること' => [false, '', 'this is body value', 'this is thumbnail', [UploadedFile::fake()->image('awsome1.png')]],
            'タイトルは99文字で入力できること' => [true, str_repeat('a', 99), 'this is body value', 'this is thumbnail', [UploadedFile::fake()->image('awsome1.png')]],
            'タイトルは100文字で入力できること' => [true, str_repeat('a', 100), 'this is body value', 'this is thumbail', [UploadedFile::fake()->image('awsome1.png')]],
            'タイトルは101文字で入力できないこと' => [false, str_repeat('a', 101), 'this is body value', 'this is thumbnail', [UploadedFile::fake()->image('awsome1.png')]],
        ];

        $body = [
            '本文の入力は必須であること' => [false, 'this is title', '', 'this is thumbnail', [UploadedFile::fake()->image('awsome1.png')]],
            '本文は999文字で入力できること' => [true, 'this is title', str_repeat('a', 999), 'this is thumbnail', [UploadedFile::fake()->image('awsome1.png')]],
            '本文は1000文字で入力できること' => [true, 'this is title', str_repeat('a', 1000), 'this is thumbnail', [UploadedFile::fake()->image('awsome1.png')]],
            '本文は1001文字で入力できないこと' => [false, 'this is title', str_repeat('a', 1001), 'this is thumbnail', [UploadedFile::fake()->image('awsome1.png')]],
        ];

        $thumbnail = [
            'thumbnailの入力は必須であること' => [false, 'this is title', 'this is body', '', [UploadedFile::fake()->image('awsome1.png')]],
            'thumbnailは99文字で入力できること' => [true, 'this is title', 'this is body', str_repeat('a', 99), [UploadedFile::fake()->image('awsome1.png')]],
            'thumbnailは100文字で入力できること' => [true, 'this is title', 'this is body', str_repeat('a', 100), [UploadedFile::fake()->image('awsome1.png')]],
            'thumbnailは101文字で入力できること' => [false, 'this is title', 'this is body', str_repeat('a', 101), [UploadedFile::fake()->image('awsome1.png')]],
        ];

        $images = [
            '画像の入力は必須であること' => [false, 'this is title', 'this is body', 'this is thumbnail', []],
            '画像は9枚入力できること' => [true, 'this is title', 'this is body', 'this is thumbnail', [
                UploadedFile::fake()->image('awsome1.png'),
                UploadedFile::fake()->image('awsome2.png'),
                UploadedFile::fake()->image('awsome3.png'),
                UploadedFile::fake()->image('awsome4.png'),
                UploadedFile::fake()->image('awsome5.png'),
                UploadedFile::fake()->image('awsome6.png'),
                UploadedFile::fake()->image('awsome7.png'),
                UploadedFile::fake()->image('awsome8.png'),
                UploadedFile::fake()->image('awsome9.png'),
            ]],
            '画像は10枚入力できること' => [true, 'this is title', 'this is body', 'this is thumbnail', [
                UploadedFile::fake()->image('awsome1.png'),
                UploadedFile::fake()->image('awsome2.png'),
                UploadedFile::fake()->image('awsome3.png'),
                UploadedFile::fake()->image('awsome4.png'),
                UploadedFile::fake()->image('awsome5.png'),
                UploadedFile::fake()->image('awsome6.png'),
                UploadedFile::fake()->image('awsome7.png'),
                UploadedFile::fake()->image('awsome8.png'),
                UploadedFile::fake()->image('awsome9.png'),
                UploadedFile::fake()->image('awsome10.png'),
            ]],
            '画像は11枚入力できないこと' => [false, 'this is title', 'this is body', 'this is thumbnail', [
                UploadedFile::fake()->image('awsome1.png'),
                UploadedFile::fake()->image('awsome2.png'),
                UploadedFile::fake()->image('awsome3.png'),
                UploadedFile::fake()->image('awsome4.png'),
                UploadedFile::fake()->image('awsome5.png'),
                UploadedFile::fake()->image('awsome6.png'),
                UploadedFile::fake()->image('awsome7.png'),
                UploadedFile::fake()->image('awsome8.png'),
                UploadedFile::fake()->image('awsome9.png'),
                UploadedFile::fake()->image('awsome10.png'),
                UploadedFile::fake()->image('awsome11.png'),
            ]],
        ];

        return [...$title, ...$body, ...$thumbnail, ...$images];
    }

    #[DataProvider('dataProvider')]
    public function testValidateRules(bool $expected, string $title, string $body, string $thumnail, array $files): void
    {
        $request = new CreatePostRequest();

        $validator = Validator::make([
                'title' => $title,
                'body' => $body,
                'thumbnail' => $thumnail,
                'images' => $files],
                $request->rules(),
                $request->messages());

        $this->assertEquals($expected, $validator->passes());
    }
}
