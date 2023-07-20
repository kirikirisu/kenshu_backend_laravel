<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use App\Models\Image;
use App\Models\PostTag;
use App\Models\Tag;
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

        $response = $this->actingAs($user)->delete($request_url, $data);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_ログインしていない状態では記事を削除できず、ログインページにリダイレクトすること(): void
    {
        $thumbnail_img = UploadedFile::fake()->image('awsome.png');

        $data = [
            'title' => 'hoge',
            'body' => 'huga',
            'thumbnail' => $thumbnail_img,
            'images' => [$thumbnail_img],
            'tags' => ['総合','グルメ','スポーツ']
        ];
        $response = $this->delete('/posts/10', $data);
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
