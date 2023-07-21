<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class GetPostDetailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_記事詳細ページにアクセスすると200が返ってくること(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $request_url = '/posts/' . $post->id;

        $response = $this->get($request_url);

        $response->assertStatus(200);
    }

    public function test_記事が見つかららなかった場合トップページにリダイレクトすること(): void
    {
        $response = $this->get('/posts/1234');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
