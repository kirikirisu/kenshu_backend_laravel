<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUuids;

    protected $fillable = ['id', 'name', 'email', 'icon_url'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['password' => 'hashed'];

}
