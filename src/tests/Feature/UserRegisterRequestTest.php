<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\UserRegisterRequest;

class UserRegisterRequestTest extends TestCase
{
    public function test_アバター画像が必須では無いこと()
    {
        $request = new UserRegisterRequest();

        $validator = $this->app['validator']->make(
            ['name' => 'test'],
            ['email' => 'test@test.com'],
            ['password' => 'testtest'],
            $request->rules()
        );

        $this->assertFalse($validator->fails());
    }

    public function test_アバター画像を入力できること()
    {
        $request = new UserRegisterRequest();
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
