<?php
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\RegisterUserRequest;

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

    public function test_アバター画像を入力できること(): void
    {
        $request = new RegisterUserRequest();
        $file = UploadedFile::fake()->image('awsome.jpg');

        $validator = $this->app['validator']->make(
            ['name' => 'test'],
            ['email' => 'test@test.com'],
            ['password' => 'testtest'],
            ['avatar' => $file],
            $request->rules()
        );

        $this->assertFalse($validator->fails());
    }
}
