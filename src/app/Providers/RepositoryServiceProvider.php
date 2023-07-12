<?php declare(strict_types=1);

namespace App\Providers;

use App\Domain\Repository\PostImageBinaryInterface;
use App\Infrastructure\Disk\PostImageBinary;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PostImageBinaryInterface::class, PostImageBinary::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
