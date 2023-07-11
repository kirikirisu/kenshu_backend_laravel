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
        $email = [
            'メアドの入力は必須であること' => [false, 'test', '', 'testtest', null],
            'メアドの形式であること' => [false, 'test', 'testtest.com', 'testtest', null],
        ];

        $password = [
            'パスワードの入力は必須であること' => [false, 'test', 'test@test.com', '', null],
            'パスワードは99文字で入力できること' => [true, 'test', 'test@test.com', str_repeat('a', 99), null],
            'パスワードは100文字で入力できること' => [true, 'test', 'test@test.com', str_repeat('a', 100), null],
            'パスワードは101文字で入力できないこと' => [false, 'test', 'test@test.com', str_repeat('a', 101), null],
        ];

        return [...$email, ...$password];
    }

    #[DataProvider('dataProvider')]
    public function testValidateRules(bool $expected, string $name, string $email, string $password, ?File $file): void
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
