<?php

namespace App\Providers;

use Application\Services\CashFlow\DelegateCashFlowAddAppService;
use Application\Services\CashFlow\DelegateCashFlowUpdateAppService;
use Application\Services\Contracts\CashFlow\AddCashFlowBalanceDomServiceInterface;
use Application\Services\Contracts\CashFlow\AddCashFlowDomServiceInterface;
use Application\Services\Contracts\CashFlow\GenerateCodeCashFlowDomServiceInterface;
use Application\Services\Contracts\CashFlow\UpdateCashFlowBalanceDomServiceInterface;
use Application\Services\Contracts\CashFlow\UpdateCashFlowDomServiceInterface;
use Domain\Aggregates\CashFlowBalance;
use Domain\Aggregates\Contracts\CashFlowBalanceAggregateInterface;
use Domain\Entities\CashFlow;
use Domain\Entities\Contracts\CashFlowEntityInterface;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface;
use Domain\Services\CashFlow\AddCashFlowBalanceDomService;
use Domain\Services\CashFlow\AddCashFlowDomService;
use Domain\Services\CashFlow\DeleteCashFlowDomService;
use Domain\Services\CashFlow\FindAllCashFlowsByDateDomService;
use Domain\Services\CashFlow\FindCashFlowByIdDomService;
use Domain\Services\CashFlow\GenerateCodeCashFlowDomService;
use Domain\Services\CashFlow\UpdateCashFlowBalanceDomService;
use Domain\Services\CashFlow\UpdateCashFlowDomService;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\Eloquent\CashFlowEloquentRepository;
use Presentation\Contracts\CashFlow\DelegateCashFlowAddAppServiceInterface;
use Presentation\Contracts\CashFlow\DelegateCashFlowUpdateAppServiceInterface;
use Presentation\Contracts\CashFlow\DeleteCashFlowDomServiceInterface;
use Presentation\Contracts\CashFlow\FindAllCashFlowsByDateDomServiceInterface;
use Presentation\Contracts\CashFlow\FindCashFlowByIdDomServiceInterface;

class CashFlowServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DelegateCashFlowAddAppServiceInterface::class, DelegateCashFlowAddAppService::class);
        $this->app->bind(AddCashFlowDomServiceInterface::class, AddCashFlowDomService::class);
        $this->app->bind(AddCashFlowBalanceDomServiceInterface::class, AddCashFlowBalanceDomService::class);
        $this->app->bind(CashFlowEntityInterface::class, CashFlow::class); 
        $this->app->bind(CashFlowEloquentRepositoryInterface::class, CashFlowEloquentRepository::class); 
        $this->app->bind(CashFlowBalanceAggregateInterface::class, CashFlowBalance::class); 
    
        $this->app->bind(DelegateCashFlowUpdateAppServiceInterface::class, DelegateCashFlowUpdateAppService::class);
        $this->app->bind(UpdateCashFlowDomServiceInterface::class, UpdateCashFlowDomService::class);
        $this->app->bind(UpdateCashFlowBalanceDomServiceInterface::class, UpdateCashFlowBalanceDomService::class);
        
        $this->app->bind(FindCashFlowByIdDomServiceInterface::class, FindCashFlowByIdDomService::class);
        $this->app->bind(FindAllCashFlowsByDateDomServiceInterface::class, FindAllCashFlowsByDateDomService::class);
        $this->app->bind(DeleteCashFlowDomServiceInterface::class, DeleteCashFlowDomService::class);
        
        $this->app->bind(GenerateCodeCashFlowDomServiceInterface::class, GenerateCodeCashFlowDomService::class);
   
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
