<?php declare(strict_types=1);

namespace App\Providers;

use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use App\Infrastructure\Disk\PostUploadedFileRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PostUploadedFileRepositoryInterface::class, PostUploadedFileRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
