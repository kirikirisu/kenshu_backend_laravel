<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Tests\TestCase;

class GetPostDetailControllerTest extends TestCase
{
    public function test_記事詳細ページにアクセスすると200が返ってくること(): void
    {
        $response = $this->get('/posts/1234');

        $response->assertStatus(200);
    }
}
