<?php

namespace Tests\Feature;

use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class UpdatePostRequestTest extends TestCase
{
    public static function dataProvider(): array
    {
        $title = [
            'タイトルの入力は必須であること' => [false, '', 'test body'],
            'タイトルは99文字で入力できること' => [true, str_repeat('a', 99), 'test body'],
            'タイトルは100文字で入力できること' => [true, str_repeat('a', 100), 'test body'],
            'タイトルは101文字で入力できること' => [false, str_repeat('a', 101), 'test body'],
        ];

        $body = [
            '本文の入力は必須であること' => [false, 'test title', ''],
            '本文は999文字で入力できること' => [true, 'test title', str_repeat('a', 999)],
            '本文は1000文字で入力できること' => [true, 'test title',  str_repeat('a', 1000)],
            '本文は1001文字で入力できないこと' => [false, 'test title', str_repeat('a', 1001)],
        ];

        return [...$title, ...$body];
    }

    #[DataProvider('dataProvider')]
    public function testValidateRules(bool $expected, string $title, string $body): void
    {
        $request = new UpdatePostRequest();

        $validator = Validator::make([
            'title' => $title,
            'body' => $body],
            $request->rules(),
            $request->messages());

        $this->assertEquals($expected, $validator->passes());
    }
}
