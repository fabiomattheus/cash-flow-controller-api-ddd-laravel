<?php

namespace App\Providers;

use Application\Services\Contracts\HelpRequest\GenerateCodeInterface;
use Domain\Services\HelpRequest\GenerateCode;
use Illuminate\Support\ServiceProvider;

class GenerateCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GenerateCodeInterface::class, GenerateCode::class);
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
