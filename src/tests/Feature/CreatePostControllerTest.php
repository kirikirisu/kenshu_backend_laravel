<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreatePostControllerTest extends TestCase
{
    public function test_ログイン状態で記事を作成でき作成後トップページにリダイレクトすること(): void
    {
        $thumbnail_img = UploadedFile::fake()->image('awsome.png');
        $user = User::factory()->create();

        $data = [
            'title' => 'hoge',
            'body' => 'huga',
            'thumbnail' => $thumbnail_img,
            'images' => [$thumbnail_img]
        ];

        $response = $this->actingAs($user)->post('/posts', $data);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_ログインしていない状態では記事を作成できずログイン画面にリダイレクトすること(): void
    {
        $thumbnail_img = UploadedFile::fake()->image('awsome.png');

        $data = [
            'title' => 'hoge',
            'body' => 'huga',
            'thumbnail' => $thumbnail_img,
            'images' => [$thumbnail_img]
        ];
        $response = $this->post('/posts', $data);
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
