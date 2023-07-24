<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Post;
use Tests\TestCase;

class DeletePostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    public function test_ログイン状態で記事を削除でき、削除後はトップページにリダイレクトすること(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $request_url = '/posts/' . $post->id;

        $response = $this->actingAs($user)->delete($request_url);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_ログインしていない状態では記事を削除できず、ログインページにリダイレクトすること(): void
    {
        $response = $this->delete('/posts/10');
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_記事の作者でない場合トップページにリダイレクトすること(): void
    {
        $user = User::factory()->count(2)->create();
        $login_user = $user[0];
        $post = Post::factory()->create(['user_id' => $user[1]->id]);
        $request_url = '/posts/' . $post->id;

        $response = $this->actingAs($login_user)->delete($request_url);

        $response->assertStatus(302);
    }

    public function test_記事が見つからない場合404が返ること(): void
    {
        $user = User::factory()->create();
        $request_url = '/posts/1234';

        $response = $this->actingAs($user)->delete($request_url);

        $response->assertStatus(404);
        $response->assertSee('Not Found');
    }
 }
