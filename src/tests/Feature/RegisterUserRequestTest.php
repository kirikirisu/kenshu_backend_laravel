<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use \Illuminate\Http\Testing\File;
use App\Http\Requests\RegisterUserRequest;
use PHPUnit\Framework\Attributes\DataProvider;

final class RegisterUserRequestTest extends TestCase
{
    /**
     * name
     * 　必須項目
     * 　最大100文字
     *   1文字以上
     *
     * email
     * 　必須項目
     * 　最大100文字
     * 　メアド形式
     *
     * password
     *   必須項目
     *   4文字以上
     *
     * avatar
     *   必須項目でない
     * 　jpg, png 形式のみ
     */

    public static function dataProvider(): array
    {
        $name = [
            '名前は入力は必須であること' => [false, '', 'test@test.com', 'testtest', null],
            '名前は1文字で入力できること' => [true, 't', 'test@test.com', 'testtest', null],
            '名前は2文字で入力できること' => [true, 'te', 'test@test.com', 'testtest', null],
            '名前は100文字で入力できること' => [true, str_repeat('a', 100), 'test@test.com', 'testtest', null],
            '名前は99文字で入力できること' => [true, str_repeat('a', 99), 'test@test.com', 'testtest', null],
            '名前は101文字で入力できないこと' => [false, str_repeat('a', 101), 'test@test.com', 'testtest', null],
        ];

        $email = [
            'メアドの入力は必須であること' => [false, 'test', '', 'testtest', null],
            'メアドの形式であること' => [false, 'test', 'testtest.com', 'testtest', null],
            'メアドは99文字で入力できること' => [true, 'test', str_repeat('a', 93).'@a.com', 'testtest', null],
            'メアドは100文字で入力できること' => [true, 'test', str_repeat('a', 94).'@a.com', 'testtest', null],
            'メアドは101文字で入力できないこと' => [false, 'test', str_repeat('a', 95).'@a.com', 'testtest', null],
        ];

        $password = [
            'パスワードの入力は必須であること' => [false, 'test', 'test@test.com', '', null],
            'パスワードは3文字で入力できないこと' => [false, 'test', 'test@test.com', 'tes', null],
            'パスワードは4文字で入力できること' => [true, 'test', 'test@test.com', 'test', null],
            'パスワードは5文字で入力できること' => [true, 'test', 'test@test.com', 'testt', null],
            'パスワードは99文字で入力できること' => [true, 'test', 'test@test.com', str_repeat('a', 99), null],
            'パスワードは100文字で入力できること' => [true, 'test', 'test@test.com', str_repeat('a', 100), null],
            'パスワードは101文字で入力できないこと' => [false, 'test', 'test@test.com', str_repeat('a', 101), null],
        ];

        $png_file = UploadedFile::fake()->image('awsome.png');
        $jpg_file = UploadedFile::fake()->image('awsome.jpg');
        $avatar = [
            'アバター画像は必須ではないこと' => [true, 'test', 'test@test.com', 'testtest', null],
            'png形式のアバター画像が入力できること' => [true, 'test', 'test@test.com', 'testtest', $png_file],
            'jpg形式のアバター画像が入力できること' => [true, 'test', 'test@test.com', 'testtest', $jpg_file],
        ];

        return [...$name, ...$email, ...$password, ...$avatar];
    }

    #[DataProvider('dataProvider')]
    final function testNameField(bool $expected, string $name, string $email, string $password, ?File $file): void
    {
        $request = new RegisterUserRequest();

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'avatar' => $file],
            $request->rules(),
            $request->messages());

        $this->assertEquals($expected, $validator->passes());
    }

//    public static function rejectProvider(): array
//    {
//        return [
//            '名前は必須で入力されること' => ['', 'test@test.com', 'testtest', null],
//            '名前が100文以上で入力できないこと' => ['１００文字はどのくらいの長さなのか実際に書いてみないと分からない。数えるのが面倒なので文字カウンタを使ってみるが空白込みの時と空白抜きの文字数をカウントしてくれるサイトはとても便利だああああああああ。。', 'test@test.com', 'testtest', null],
//            'failしてほしい' => ['hoge', 'test@test.com', 'testtest', null],
//        ];
//    }
//
//    #[DataProvider('rejectProvider')]
//    final public function test_Reject(string $name, string $email, string $password, ?File $file): void
//    {
//        $request = new RegisterUserRequest();
//
//        $validator = $this->app['validator']->make(
//            ['name' => $name],
//            ['email' => $email],
//            ['password' => $password],
//            ['avatar' => $file],
//            $request->rules()
//        );
//
//        $this->assertTrue($validator->errors()->has('name'));
//    }



//    public function dataProvider()
//    {
//        return [
//            'アバター画像が必須では無いこと' => ['test', 'test@test.com', 'testtest', null],
//            'JPGのアバター画像を入力できること'  => ['test', 'test@test.com', 'testtest', UploadedFile::fake()->image('awsome.jpg')],
//            'PNGのアバター画像を入力できること'  => ['test', 'test@test.com', 'testtest', UploadedFile::fake()->image('awsome.png')],
//            ''  => ['', 'test@test.com', 'testtest', UploadedFile::fake()->image('awsome.png')],
//        ];
//    }

}
