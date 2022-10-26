<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\PhysicalPersonRepository;
use Domain\Repositories\PhysicalPersonRepositoryInterface;

class PhysicalPersonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PhysicalPersonRepositoryInterface::class, PhysicalPersonRepository::class);
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
