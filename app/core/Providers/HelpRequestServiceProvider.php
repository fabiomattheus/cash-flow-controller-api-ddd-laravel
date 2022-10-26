<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\HelpRequestRepository;
use Application\Services\HelpRequest\CreateHelpRequest;
use Domain\Entities\Contracts\HelpRequestEntityInterface;
use Domain\Entities\HelpRequest;
use Domain\Repositories\HelpRequestRepositoryInterface;
use Presentation\Contracts\HelpRequest\CreateHelpRequestInterface;
use Presentation\Contracts\HelpRequest\GetHelpRequestByIdInterface;
use tests\Unit\Application\Services\HelpRequest\GetHelpRequestByIdTest;

class HelpRequestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(CreateHelpRequestInterface::class, CreateHelpRequest::class);
        // $this->app->bind(GetHelpRequestByIdInterface::class, GetHelpRequestByIdTest::class);
        // $this->app->bind(HelpRequestEntityInterface::class, HelpRequest::class);




        // $this->app->bind(HelpRequestRepositoryInterface::class, HelpRequestRepository::class);
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
