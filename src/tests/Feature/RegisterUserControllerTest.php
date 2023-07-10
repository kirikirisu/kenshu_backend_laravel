<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
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

    public function test_名前入力に不足があった場合にエラーと共に登録画面にリダイレクトすること()
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

    public function test_メールアドレスに不足があった場合にエラーと共に登録画面にリダイレクトすること()
    {
        $data = [
            'name' => 'jhon',
            'email' => '',
            'password' => 'password123',
        ];

        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['email']);
    }

    public function test_パスワードに不足があった場合にエラーと共に登録画面にリダイレクトすること()
    {
        $data = [
            'name' => 'jhon',
            'email' => 'jhon@example.com',
            'password' => '',
        ];

        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password']);
    }

    public function test_ファイルに不足があった場合にエラーと共に登録画面にリダイレクトすること()
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
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['avatar']);
    }
}
