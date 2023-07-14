<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Tests\TestCase;

class RegisterUserViewTest extends TestCase
{
    public function test_ユーザー登録画面にアクセスすると200が返ってくること(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
