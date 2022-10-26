<?php

namespace App\Providers;

use Domain\Services\TEntity\StoreFiles;
use Illuminate\Support\ServiceProvider;
use Application\Services\Contracts\TEntity\StoreFilesInterface;

class StoreFilesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StoreFilesInterface::class, StoreFiles::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
