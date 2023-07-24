<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Post;
use Tests\TestCase;

class UpdatePostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $patch_data = [
        'title' => 'hoge',
        'body' => 'huga',
    ];

    public function test_ログイン状態で記事を編集でき、編集後は記事詳細ページにリダイレクトすること(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $request_url = '/posts/' . $post->id;

        $response = $this->actingAs($user)->patch($request_url, $this->patch_data);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect($request_url);
    }

    public function test_ログインしていない状態では記事を編集できず、ログインページにリダイレクトすること(): void
    {
        $response = $this->patch('/posts/10', $this->patch_data);
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_記事の作者でない場合トップページにリダイレクトすること(): void
    {
        $user = User::factory()->count(2)->create();
        $login_user = $user[0];
        $post = Post::factory()->create(['user_id' => $user[1]->id]);
        $request_url = '/posts/' . $post->id;

        $response = $this->actingAs($login_user)->patch($request_url, $this->patch_data);

        $response->assertStatus(403);
    }

    public function test_記事が見つからない場合404が返ること(): void
    {
        $user = User::factory()->create();
        $request_url = '/posts/1234';

        $response = $this->actingAs($user)->patch($request_url, $this->patch_data);

        $response->assertStatus(404);
        $response->assertSee('Not Found');
    }
}
