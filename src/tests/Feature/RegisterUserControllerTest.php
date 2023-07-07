<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @noinspection NonAsciiCharacters */
    public function test_ユーザー登録後にログイン状態になること()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/register', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertEquals(1, session('user_id'));
    }

    /** @noinspection NonAsciiCharacters */
    public function test_名前入力に不足があった場合にエラーが返ること()
    {
        $data = [
            'name' => '',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['name']);
    }

    /** @noinspection NonAsciiCharacters */
    public function test_メールアドレスに不足があった場合にエラーが返ること()
    {
        $data = [
            'name' => 'jhon',
            'email' => '',
            'password' => 'password123',
        ];

        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['email']);
    }

    /** @noinspection NonAsciiCharacters */
    public function test_パスワードに不足があった場合にエラーが返ること()
    {
        $data = [
            'name' => 'jhon',
            'email' => 'jhon@example.com',
            'password' => '',
        ];

        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['password']);
    }
}
