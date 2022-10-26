<?php

namespace App\Providers;

use Domain\Entities\Contracts\RequesterEntityInterface;
use Domain\Entities\Requester;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\RequesterRepository;
use Domain\Repositories\RequesterRepositoryInterface;
use Domain\Services\Requester\CreateRequester;
use Presentation\Contracts\Requester\CreateRequesterInterface;

class RequesterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CreateRequesterInterface::class, CreateRequester::class);
        $this->app->bind(RequesterEntityInterface::class, Requester::class);
        $this->app->bind(RequesterRepositoryInterface::class, RequesterRepository::class);
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
