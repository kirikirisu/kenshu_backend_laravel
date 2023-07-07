<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LoginUserRequestTest extends TestCase
{
    public static function dataProvider(): array
    {
        $name = [
            '名前は入力は必須であること' => [false, '', 'test@test.com', 'testtest', null],
            '名前は1文字で入力できること' => [true, 't', 'test@test.com', 'testtest', null],
            '名前は2文字で入力できること' => [true, 'te', 'test@test.com', 'testtest', null],
            '名前は100文字で入力できること' => [true, str_repeat('a', 100), 'test@test.com', 'testtest', null],
            '名前は99文字で入力できること' => [true, str_repeat('a', 99), 'test@test.com', 'testtest', null],
            '名前は101文字で入力できないこと' => [false, str_repeat('a', 101), 'test@test.com', 'testtest', null],
        ];

        $password = [
            'パスワードの入力は必須であること' => [false, 'test', 'test@test.com', '', null],
            'パスワードは3文字で入力できないこと' => [false, 'test', 'test@test.com', 'tes', null],
            'パスワードは4文字で入力できること' => [true, 'test', 'test@test.com', 'test', null],
            'パスワードは5文字で入力できること' => [true, 'test', 'test@test.com', 'testt', null],
            'パスワードは99文字で入力できること' => [true, 'test', 'test@test.com', str_repeat('a', 99), null],
            'パスワードは100文字で入力できること' => [true, 'test', 'test@test.com', str_repeat('a', 100), null],
            'パスワードは101文字で入力できないこと' => [false, 'test', 'test@test.com', str_repeat('a', 101), null],
        ];

        return [...$name, ...$password];
    }

    #[DataProvider('dataProvider')]
    final function testInput(bool $expected, string $name, string $email, string $password, ?File $file): void
    {
        $request = new LoginUserRequest();

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'avatar' => $file],
            $request->rules(),
            $request->messages());

        $this->assertEquals($expected, $validator->passes());
    }
}
