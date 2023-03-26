<?php

namespace Presentation\Controllers\Api\CashFlow;

use App\Http\Controllers\Controller;

use Presentation\Contracts\CashFlow\DelegateCashFlowAddAppServiceInterface  as AddCashFlow;


class AddCashFlowApiController extends Controller
{
    protected $addCashFlow;

    public function __construct(
        AddCashFlow  $addCashFlow,
    ) {
        $this->addCashFlow =  $addCashFlow;
    }
    public function add()
    {
        return $this->addCashFlow->execute();
    }
}
