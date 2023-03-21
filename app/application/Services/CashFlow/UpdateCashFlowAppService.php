<?php

namespace Application\Services\CashFlow;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Application\Services\Contracts\CashFlow\UpdateCashFlowDomServiceInterface as UpdateCashFlow;
use Application\Services\Contracts\CashFlow\UpdateCashFlowBalanceDomServiceInterface as UpdateCashFlowBalance;
use Domain\Dto\Contracts\DtoInterface;
use Presentation\Contracts\CashFlow\UpdateCashFlowAppServiceInterface;

class UpdateCashFlowAppService implements UpdateCashFlowAppServiceInterface
{  
    protected $updateCashFlow;
    protected $updateCashFlowBalance;
    
    public function __construct(
        UpdateCashFlow $updateCashFlow,
        UpdateCashFlowBalance $updateCashFlowBalance,
    ) {
        $this->updateCashFlow = $updateCashFlow;
        $this->updateCashFlowBalance = $updateCashFlowBalance;
    }

    public function execute()
    {
        DB::beginTransaction();
        $request = App::make(Request::class);
        $dto = App::makeWith(DtoInterface::class);
        $this->updateCashFlow->execute();
        $this->updateCashFlowBalance->execute();
        DB::commit();
        return $dto::toJson(200, 'messages.success_create_cash_flow');
        unset($request, $dto);
    }
}
