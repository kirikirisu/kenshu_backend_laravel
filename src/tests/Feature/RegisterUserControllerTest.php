<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegisterUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ユーザー登録後にログイン状態になりトップページにリダイレクトすること()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/register', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertTrue(Auth::check());
    }

    public function test_入力に不足があった場合にエラーと共に登録画面にリダイレクトすること()
    {
        $data = [
            'name' => '',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/register', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['name']);
    }
}
