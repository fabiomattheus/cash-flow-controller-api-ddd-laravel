<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\LegalPersonRepository;
use Domain\Repositories\LegalPersonRepositoryInterface;

class LegalPersonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LegalPersonRepositoryInterface::class, LegalPersonRepository::class);
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
