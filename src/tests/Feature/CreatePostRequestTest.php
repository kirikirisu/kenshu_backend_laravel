<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CreatePostRequestTest extends TestCase
{
    public static function dataProvider(): array
    {
        $thumbnail_img = UploadedFile::fake()->image('awsome.png');

        $title = [
            'タイトルの入力は必須であること' => [false, '', 'this is body value', $thumbnail_img, 
                [UploadedFile::fake()->image('awsome1.png')], 
                ['総合', 'グルメ', 'スポーツ']],
            'タイトルは99文字で入力できること' => [true, str_repeat('a', 99), 'this is body value', $thumbnail_img, 
                [UploadedFile::fake()->image('awsome1.png')],
                ['総合', 'グルメ', 'スポーツ']],
            'タイトルは100文字で入力できること' => [true, str_repeat('a', 100), 'this is body value', $thumbnail_img, 
                [UploadedFile::fake()->image('awsome1.png')], 
                ['総合', 'グルメ', 'スポーツ']],
            'タイトルは101文字で入力できないこと' => [false, str_repeat('a', 101), 'this is body value', $thumbnail_img, 
                [UploadedFile::fake()->image('awsome1.png')], 
                ['総合', 'グルメ', 'スポーツ']],
        ];

        $body = [
            '本文の入力は必須であること' => [false, 'this is title', '', $thumbnail_img, 
                [UploadedFile::fake()->image('awsome1.png')],
                ['総合', 'グルメ', 'スポーツ']],
            '本文は999文字で入力できること' => [true, 'this is title', str_repeat('a', 999), $thumbnail_img, 
                [UploadedFile::fake()->image('awsome1.png')],
                ['総合', 'グルメ', 'スポーツ']],
            '本文は1000文字で入力できること' => [true, 'this is title', str_repeat('a', 1000), $thumbnail_img, 
                [UploadedFile::fake()->image('awsome1.png')],
                ['総合', 'グルメ', 'スポーツ']],
            '本文は1001文字で入力できないこと' => [false, 'this is title', str_repeat('a', 1001), $thumbnail_img, 
                [UploadedFile::fake()->image('awsome1.png')],
                ['総合', 'グルメ', 'スポーツ']],
        ];

        $thumbnail = [
            'サムネイルの入力は必須であること' => [false, 'this is title', 'this is body', null, 
                [UploadedFile::fake()->image('awsome1.png')],
                ['総合', 'グルメ', 'スポーツ']],
            'svg形式のサムネイルは入力できないこと' => [false, 'this is title', 'this is body', UploadedFile::fake()->image('awsome1.svg'), 
                [UploadedFile::fake()->image('awsome1.svg')],
                ['総合', 'グルメ', 'スポーツ']],
        ];

        $images = [
            '画像の入力は必須であること' => [false, 'this is title', 'this is body', $thumbnail_img, [], ['総合', 'グルメ', 'スポーツ']],
            'svg形式の画像は入力できないこと' => [false, 'this is title', 'this is body', $thumbnail_img, [UploadedFile::fake()->image('awsome1.svg')], ['総合', 'グルメ', 'スポーツ']],
            '画像は9枚入力できること' => [true, 'this is title', 'this is body', $thumbnail_img, [
                UploadedFile::fake()->image('awsome1.png'),
                UploadedFile::fake()->image('awsome2.png'),
                UploadedFile::fake()->image('awsome3.png'),
                UploadedFile::fake()->image('awsome4.png'),
                UploadedFile::fake()->image('awsome5.png'),
                UploadedFile::fake()->image('awsome6.png'),
                UploadedFile::fake()->image('awsome7.png'),
                UploadedFile::fake()->image('awsome8.png'),
                UploadedFile::fake()->image('awsome9.png')],
                ['総合', 'グルメ', 'スポーツ'],
            ],
            '画像は10枚入力できること' => [true, 'this is title', 'this is body', $thumbnail_img, [
                UploadedFile::fake()->image('awsome1.png'),
                UploadedFile::fake()->image('awsome2.png'),
                UploadedFile::fake()->image('awsome3.png'),
                UploadedFile::fake()->image('awsome4.png'),
                UploadedFile::fake()->image('awsome5.png'),
                UploadedFile::fake()->image('awsome6.png'),
                UploadedFile::fake()->image('awsome7.png'),
                UploadedFile::fake()->image('awsome8.png'),
                UploadedFile::fake()->image('awsome9.png'),
                UploadedFile::fake()->image('awsome10.png')],
                ['総合', 'グルメ', 'スポーツ'],
            ],
            '画像は11枚入力できないこと' => [false, 'this is title', 'this is body', $thumbnail_img, [
                UploadedFile::fake()->image('awsome1.png'),
                UploadedFile::fake()->image('awsome2.png'),
                UploadedFile::fake()->image('awsome3.png'),
                UploadedFile::fake()->image('awsome4.png'),
                UploadedFile::fake()->image('awsome5.png'),
                UploadedFile::fake()->image('awsome6.png'),
                UploadedFile::fake()->image('awsome7.png'),
                UploadedFile::fake()->image('awsome8.png'),
                UploadedFile::fake()->image('awsome9.png'),
                UploadedFile::fake()->image('awsome10.png'),
                UploadedFile::fake()->image('awsome11.png')],
                ['総合', 'グルメ', 'スポーツ'],
            ],
        ];

        return [...$title, ...$body, ...$thumbnail, ...$images];
    }

    #[DataProvider('dataProvider')]
    public function testValidateRules(bool $expected, string $title, string $body, ?File $thumnail, array $files, array $categories): void
    {
        $request = new CreatePostRequest();

        $validator = Validator::make([
                'title' => $title,
                'body' => $body,
                'thumbnail' => $thumnail,
                'images' => $files,
                'categories' => $categories
                ],
                $request->rules(),
                $request->messages());

        $this->assertEquals($expected, $validator->passes());
    }
}
