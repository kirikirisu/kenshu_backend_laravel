<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetEditPostPageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ログインしていない状態で記事編集ページにアクセスするとログインページにリダイレクトすること(): void
    {
        $response = $this->get('/posts/1234/edit');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_記事編集ページにアクセスすると200が返ってくること(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $request_url = '/posts/' . $post->id . '/edit';

        $response = $this->actingAs($user)->get($request_url);

        $response->assertStatus(200);
    }

    public function test_記事が見つからない場合トップページにリダイレクトすること(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/posts/1234/edit');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
