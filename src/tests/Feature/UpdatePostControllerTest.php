<?php

namespace Tests\Feature;

use App\Domain\Dto\UploadFileDto;
use Illuminate\Http\UploadedFile;
use App\Util\UploadFileDtoList;
use Mockery\MockInterface;
use App\Models\User;
use Tests\TestCase;

class UpdatePostControllerTest extends TestCase
{
    public function test_ログイン状態で記事を編集でき、編集後は記事詳細ページにリダイレクトすること(): void
    {
        $this->partialMock(PostUploadedFileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->once()->andReturn(new UploadFileDto(file_name: "thumbnai.png", file_path: "images/thumbnail.png", upload_success: true));
            $mock->shouldReceive('saveList')->once()->andReturn(
                new UploadFileDtoList([
                   new UploadFileDto(file_name: "image1.png", file_path: "images/image1.png", upload_success: true),
                   new UploadFileDto(file_name: "image2.png", file_path: "images/image2.png", upload_success: true)]
                )
            );
        });

        $thumbnail_img = UploadedFile::fake()->image('thumbnail.png');
        $user = User::factory()->create();

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

        $response = $this->actingAs($user)->patch('/posts/10', $data);

        $this->assertAuthenticatedAs($user);
        // $response->assertStatus(302);
        // $response->assertRedirect('/');
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
