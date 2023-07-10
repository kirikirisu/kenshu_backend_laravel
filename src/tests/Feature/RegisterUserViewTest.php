<?php declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class RegisterUserViewTest extends TestCase
{
    public function test_ユーザー登録画面にアクセスすると200が帰ってくること(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
