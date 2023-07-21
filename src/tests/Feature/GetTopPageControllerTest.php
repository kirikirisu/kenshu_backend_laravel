<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Tests\TestCase;

class GetTopPageControllerTest extends TestCase
{
    public function test_トップページにアクセスすると200が返ってくること(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
