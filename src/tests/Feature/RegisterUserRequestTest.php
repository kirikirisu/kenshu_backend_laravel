<?php
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\RegisterUserRequest;
use \Illuminate\Http\Testing\File;

class UserRegisterRequestTest extends TestCase
{
    public function test_アバター画像が必須では無いこと(): void
    {
        $request = new RegisterUserRequest();

        $validator = $this->app['validator']->make(
            ['name' => 'test'],
            ['email' => 'test@test.com'],
            ['password' => 'testtest'],
            $request->rules()
        );

        $this->assertFalse($validator->fails());
    }

    /**
     * @dataProvider dataProvider
     */
    public function test(string $name, string $email, string $password, File $file): void
    {
        $request = new RegisterUserRequest();

        $validator = $this->app['validator']->make(
            ['name' => $name],
            ['email' => $email],
            ['password' => $password],
            ['avatar' => $file],
            $request->rules()
        );

        $this->assertFalse($validator->fails());
    }

    public function dataProvider()
    {
        return [
            'アバター画像を入力できること'  => ['test', 'test@test.com', 'testtest', UploadedFile::fake()->image('awsome.jpg')],
        ];
    }

}
