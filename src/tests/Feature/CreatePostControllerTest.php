<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreatePostControllerTest extends TestCase
{
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
        
        $response->assertRedirectContains('/login');
        $response->assertStatus(302);
    }
}
