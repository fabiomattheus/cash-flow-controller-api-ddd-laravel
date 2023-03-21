<?php

namespace Application\Services\CashFlow;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use Application\Services\Contracts\CashFlow\GenerateCodeCashFlowDomServiceInterface as GenerateCode;
use Application\Services\Contracts\CashFlow\AddCashFlowDomServiceInterface as AddCashFlow;
use Application\Services\Contracts\CashFlow\AddCashFlowBalanceDomServiceInterface as AddCashFlowBalance;
use Domain\Dto\Contracts\DtoInterface;
use Presentation\Contracts\CashFlow\AddCashFlowAppServiceInterface;

class AddCashFlowAppService implements AddCashFlowAppServiceInterface
{  
    protected $addCashFlow;
    protected $addCashFlowBalance;
    protected $generateCode;
    
    public function __construct(
        AddCashFlow $addCashFlow,
        AddCashFlowBalance $addCashFlowBalance,
        GenerateCode $generateCode,
    ) {
        $this->addCashFlow = $addCashFlow;
        $this->addCashFlowBalance = $addCashFlowBalance;
        $this->generateCode = $generateCode;
    }

    public function execute()
    {
        DB::beginTransaction();
        $request = App::make(Request::class);
        $dto = App::makeWith(DtoInterface::class);
        $this->generateCode->execute();
        $this->addCashFlow->execute();
        $this->addCashFlowBalance->execute();
        DB::commit();
        return $dto::toJson(201, 'messages.success_create_cash_flow');
        unset($request, $dto);
    }
}
