<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\TenantRepository;
use Domain\Repositories\TenantRepositoryInterface;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
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
