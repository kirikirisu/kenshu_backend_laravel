<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class RegisterUserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * id, name, email, password　が挿入されること
     * passwordはhashになっていること
     * idが生成されていること
     * password, remember_tokenは取り出せないこと
     */

    public function test_avatarなしでユーザー登録できること(): void
    {
        $registerData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ];

        $user = new User();
        $user->name = $registerData['name'];
        $user->email = $registerData['email'];
        $user->password = $registerData['password'];
        $createdUser = $user->save();

        $this->assertTrue($createdUser);
        $this->assertNotNull($user->id);
        $this->assertIsString($user->id);
        $this->assertEquals($registerData['name'], $user->name);
        $this->assertEquals($registerData['email'], $user->email);
        $this->assertTrue(Hash::check($registerData['password'], $user->password));

        $this->assertArrayNotHasKey('password', $user->toArray());
    }

    public function test_avatarを合わせてユーザー登録できること(): void
    {
        $registerData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'avatar' => '/public/images/awsome.png'
        ];

        $user = new User();
        $user->name = $registerData['name'];
        $user->email = $registerData['email'];
        $user->password = $registerData['password'];
        $user->icon_url = $registerData['avatar'];
        $createdUser = $user->save();

        $this->assertTrue($createdUser);
        $this->assertNotNull($user->id);
        $this->assertIsString($user->id);
        $this->assertEquals($registerData['name'], $user->name);
        $this->assertEquals($registerData['email'], $user->email);
        $this->assertTrue(Hash::check($registerData['password'], $user->password));
    }
}
