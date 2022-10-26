<?php

namespace App\Providers;

use Application\Services\Contracts\Chat\ChatInterface;
use Application\Services\HelpRequest\CreateHelpRequest;
use Application\Services\HelpRequest\GetHelpRequestById;
use Domain\Aggregates\Chat;
use Domain\Aggregates\Contracts\ChatAggregateInterface;
use Domain\Dto\Contracts\DtoInterface;
use Domain\Dto\Dto;
use Domain\Entities\Contracts\HelpRequestEntityInterface;
use Domain\Entities\Contracts\PurchaseItemEntityInterface;
use Domain\Entities\HelpRequest;
use Domain\Entities\PurchaseItem;
use Domain\Repositories\HelpRequestRepositoryInterface;
use Domain\VOs\IdVo;
use Domain\VOs\TypeVo;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\HelpRequestRepository;
use Presentation\Contracts\HelpRequest\CreateHelpRequestInterface;
use Presentation\Contracts\HelpRequest\GetHelpRequestByIdInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Domain\VOs\Contracts\IdVoInterface', function ($params) {
            $request = $this->app->make(Request::class);
            return new IdVo(Array('id'=>$request->id));
        });

        $this->app->bind('Domain\VOs\Contracts\TypeVoInterface', function ($params) {
            $request = $this->app->make(Request::class);
            return new TypeVo(Array('type'=>$request->type));
        });

        $this->app->bind(DtoInterface::class, function ($params) {
            return Dto::class;
        });

        $this->app->bind(CreateHelpRequestInterface::class, CreateHelpRequest::class);
        $this->app->bind(GetHelpRequestByIdInterface::class, GetHelpRequestById::class);
        $this->app->bind(HelpRequestEntityInterface::class, HelpRequest::class);
        $this->app->bind(HelpRequestRepositoryInterface::class, HelpRequestRepository::class);
        $this->app->bind(ChatAggregateInterface::class, Chat::class);
        $this->app->bind(PurchaseItemEntityInterface::class, PurchaseItem::class);
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
