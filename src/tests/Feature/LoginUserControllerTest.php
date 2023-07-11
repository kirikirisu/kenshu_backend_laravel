<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

use Tests\TestCase;

class LoginUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ユーザーがログインするとトップページにリダイレクトすること(): void
    {
        User::factory()->create();

        $data = [
            'email' => 'john@example.com',
            'password' => 'password123'
        ];

        $response = $this->post('/login', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertTrue(Auth::check());
    }

    public function test_認証情報が間違っていた場合にログインが失敗しログイン画面にリダイレクトすること(): void
    {
        User::factory()->create();

        $data = [
            'email' => 'bad@example.com',
            'password' => 'password123'
        ];

        $response = $this->post('/login', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertFalse(Auth::check());
    }
}
