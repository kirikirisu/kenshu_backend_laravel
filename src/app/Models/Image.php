<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $post_id
 * @property string $url
 */
class Image extends Model
{
    use HasUuids;

    protected $fillable = ['post_id', 'url'];
}
