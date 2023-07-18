<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Mockery;
use Mockery\MockInterface;
use App\Infrastructure\Disk\PostUploadedFileRepository;
use App\Domain\Dto\UploadFileDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Util\UploadFileDtoList;

class CreatePostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function tearDown(): void
    {
      parent::tearDown();
      Mockery::close();
    }

    public function test_ログイン状態で記事を作成でき作成後トップページにリダイレクトすること(): void
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
            'images' => [$thumbnail_img],
            'tags' => ['総合','グルメ','スポーツ']
        ];
        $response = $this->post('/posts', $data);
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_サムネイルがアップロードできなかった場合に投稿が失敗し、トップページにリダイレクトすること(): void
    {
        $this->partialMock(PostUploadedFileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->once()->andReturn(new UploadFileDto(file_name: "thumbnai.png", file_path: "images/thumbnail.png", upload_success: false));
            $mock->shouldNotHaveReceived('saveList');
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
                UploadedFile::fake()->image('awsome3.png'),
            ],
            'tags' => ['総合','グルメ','スポーツ']
        ];

        $response = $this->actingAs($user)->post('/posts', $data);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertEquals('サムネイルのアップロードに失敗し投稿が失敗しました。', session('failed_create_post'));
    }

    public function test_複数アップロードされた画像がどれか一つでもアップロードできなかった場合に投稿が失敗し、トップページにリダイレクトすること(): void
    {
        $this->partialMock(PostUploadedFileRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('save')->once()->andReturn(new UploadFileDto(file_name: "thumbnai.png", file_path: "images/thumbnail.png", upload_success: true));
            $mock->shouldReceive('saveList')->once()->andReturn(
                new UploadFileDtoList([
                   new UploadFileDto(file_name: "image1.png", file_path: "images/image1.png", upload_success: true),
                   new UploadFileDto(file_name: "image2.png", file_path: "images/image2.png", upload_success: true),
                   new UploadFileDto(file_name: "image3.png", file_path: "images/image3.png", upload_success: false)]
                ));
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
                UploadedFile::fake()->image('awsome3.png'),
            ],
            'tags' => ['総合','グルメ','スポーツ']
        ];

        $response = $this->actingAs($user)->post('/posts', $data);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertEquals('画像のアップロードに失敗し投稿が失敗しました。', session('failed_create_post'));
    }
}
