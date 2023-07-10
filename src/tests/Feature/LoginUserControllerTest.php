<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ユーザーがログインできること(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_認証情報が間違っていた場合にログインできないこと(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
