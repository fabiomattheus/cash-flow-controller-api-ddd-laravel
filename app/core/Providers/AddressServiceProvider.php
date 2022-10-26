<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\AddressRepository;
use Domain\Repositories\AddressRepositoryInterface;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
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
