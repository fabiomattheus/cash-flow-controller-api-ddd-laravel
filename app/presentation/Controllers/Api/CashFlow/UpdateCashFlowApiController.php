<?php

namespace Presentation\Controllers\Api\CashFlow;

use App\Http\Controllers\Controller;

use Presentation\Contracts\CashFlow\DelegateCashFlowUpdateAppServiceInterface as UpdateCashFlow;


class UpdateCashFlowApiController extends Controller
{
    protected $updateCashFlow;

    public function __construct(
        UpdateCashFlow  $updateCashFlow,
    ) {
        $this->updateCashFlow =  $updateCashFlow;
    }

    public function update()
    {
        return $this->updateCashFlow->execute();
    }
}
