<?php

namespace App\Providers;

use Domain\Entities\Help;
use Illuminate\Support\ServiceProvider;
use Application\Services\Help\CreateHelp;
use Application\Services\Help\DeleteHelp;
use Application\Services\Help\UpdateHelp;
use Application\Services\Help\GetAllHelps;
use Application\Services\Help\GetHelpById;
use Application\Services\Help\GetHelpsByType;
use Infrastructure\Repositories\HelpRepository;
use Domain\Repositories\HelpRepositoryInterface;
use Domain\Entities\Contracts\HelpEntityInterface;
use Presentation\Contracts\Help\CreateHelpInterface;
use Presentation\Contracts\Help\DeleteHelpInterface;
use Presentation\Contracts\Help\UpdateHelpInterface;
use Presentation\Contracts\Help\GetAllHelpsInterface;
use Presentation\Contracts\Help\GetHelpByIdInterface;
use Presentation\Contracts\Help\GetHelpsByTypeInterface;

class HelpServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //  $this->app->bind('Domain\Dto\Contracts\OtdInterface', 'Domain\Dto\Dto');
         $this->app->bind(CreateHelpInterface::class, CreateHelp::class);
         $this->app->bind(DeleteHelpInterface::class, DeleteHelp::class);
         $this->app->bind(UpdateHelpInterface::class, UpdateHelp::class);
         $this->app->bind(GetHelpByIdInterface::class, GetHelpById::class);
         $this->app->bind(GetAllHelpsInterface::class, GetAllHelps::class);
         $this->app->bind(GetHelpsByTypeInterface::class, GetHelpsByType::class);
         $this->app->bind(HelpRepositoryInterface::class, HelpRepository::class);
         $this->app->bind(HelpEntityInterface::class, Help::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
