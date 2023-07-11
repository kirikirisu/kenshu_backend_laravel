<?php declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class LoginUserViewTest extends TestCase
{
    public function test_ログイン画面にアクセスすると200が返ってくること(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
