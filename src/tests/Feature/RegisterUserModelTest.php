<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

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

    public array $registerData = [
      'name' => 'John Doe',
      'email' => 'john@example.com',
      'password' => 'password',
      'icon_url' => '/public/images/awsome.png'
    ];

    public function test_nameが挿入されること(): void
    {

        $user = new User();
        $user->name = $this->registerData['name'];
        $user->email = $this->registerData['email'];
        $user->password = $this->registerData['password'];
        $user->icon_url = null;
        $createdUser = $user->save();

        $this->assertTrue($createdUser);
        $this->assertNotNull($user->name);
        $this->assertIsString($user->name);
        $this->assertEquals($this->registerData['name'], $user->name);
    }

    public function test_emailが挿入されること(): void
    {
        $user = new User();
        $user->name = $this->registerData['name'];
        $user->email = $this->registerData['email'];
        $user->password = $this->registerData['password'];
        $user->icon_url = null;
        $createdUser = $user->save();

        $this->assertTrue($createdUser);
        $this->assertNotNull($user->email);
        $this->assertIsString($user->email);
        $this->assertEquals($this->registerData['email'], $user->email);
    }

    public function test_passwordが挿入されること(): void
    {
        $user = new User();
        $user->name = $this->registerData['name'];
        $user->email = $this->registerData['email'];
        $user->password = $this->registerData['password'];
        $user->icon_url = null;
        $createdUser = $user->save();

        $this->assertTrue($createdUser);
        $this->assertNotNull($user->password);
        $this->assertIsString($user->password);
        $this->assertTrue(Hash::check($this->registerData['password'], $user->password));
    }

    public function test_passwordが取り出せないこと(): void
    {
        $user = new User();
        $user->name = $this->registerData['name'];
        $user->email = $this->registerData['email'];
        $user->password = $this->registerData['password'];
        $user->icon_url = null;
        $user->save();

        $this->assertArrayNotHasKey('password', $user->toArray());
    }

    public function test_iconが挿入されること(): void
    {
        $user = new User();
        $user->name = $this->registerData['name'];
        $user->email = $this->registerData['email'];
        $user->password = $this->registerData['password'];
        $user->icon_url = $this->registerData['icon_url'];
        $createdUser = $user->save();

        $this->assertTrue($createdUser);
        $this->assertNotNull($user->icon_url);
        $this->assertIsString($user->icon_url);
        $this->assertEquals($this->registerData['icon_url'], $user->icon_url);
    }
}
