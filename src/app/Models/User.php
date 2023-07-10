<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;


/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $icon_url
 */
class User extends Model implements 
    AuthenticatableContract,
    AuthorizableContract
{
    use HasUuids, Authenticatable, Authorizable;

    protected $fillable = ['id', 'name', 'email', 'icon_url'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['password' => 'hashed'];

}
