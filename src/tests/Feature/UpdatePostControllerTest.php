<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Post;
use Tests\TestCase;

class UpdatePostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ログイン状態で記事を編集でき、編集後は記事詳細ページにリダイレクトすること(): void
    {
        $thumbnail_img = UploadedFile::fake()->image('thumbnail.png');
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $request_url = '/posts/' . $post->id;

        $data = [
            'title' => 'hoge',
            'body' => 'huga',
            'thumbnail' => $thumbnail_img,
            'images' => [
                UploadedFile::fake()->image('awsome1.png'),
                UploadedFile::fake()->image('awsome2.png'),
            ],
            'tags' => ['総合','グルメ','スポーツ']
        ];

        $response = $this->actingAs($user)->patch($request_url, $data);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect($request_url);
    }

    public function test_ログインしていない状態では記事を編集できず、ログインページにリダイレクトすること(): void
    {
        $thumbnail_img = UploadedFile::fake()->image('awsome.png');

        $data = [
            'title' => 'hoge',
            'body' => 'huga',
            'thumbnail' => $thumbnail_img,
            'images' => [$thumbnail_img],
            'tags' => ['総合','グルメ','スポーツ']
        ];
        $response = $this->patch('/posts/10', $data);
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
