<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RegisterUserControllerTest extends TestCase
{
    use RefreshDatabase;
    const BASE_URL = 'http://localhost:8888';

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
        $response->assertRedirect(self::BASE_URL);
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
        $response->assertRedirect(self::BASE_URL . '/register');
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
        $response->assertRedirect(self::BASE_URL . '/register');
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
        $response->assertRedirect(self::BASE_URL . '/register');
        $response->assertSessionHasErrors(['password']);
    }

    /** @noinspection NonAsciiCharacters */
    public function test_ファイルに不足があった場合にエラーが返ること()
    {
        $svg_file = UploadedFile::fake()->image('awsome.svg');

        $data = [
            'name' => 'jhon',
            'email' => 'jhon@example.com',
            'password' => 'password',
            'avatar' => $svg_file
        ];

        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertRedirect(self::BASE_URL . '/register');
        $response->assertSessionHasErrors(['avatar']);
    }
}
