<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

use Tests\TestCase;

class LoginUserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void 
    {
        parent::setUp();

        User::factory()->create();
    }

    public function test_ユーザーがログインするとトップページにリダイレクトすること(): void
    {
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
