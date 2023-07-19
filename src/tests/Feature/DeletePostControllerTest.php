<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DeletePostControllerTest extends TestCase
{
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
        $response = $this->patch('/posts/10', $data);
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
