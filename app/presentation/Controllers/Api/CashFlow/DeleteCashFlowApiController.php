<?php

namespace Presentation\Controllers\Api\CashFlow;

use App\Http\Controllers\Controller;
use Presentation\Contracts\CashFlow\DeleteCashFlowDomServiceInterface as DeleteCashFlow;

class DeleteCashFlowApiController extends Controller
{
    protected $deleteCashFlow;

    public function __construct(
        DeleteCashFlow  $deleteCashFlow,
    ) {
        $this->deleteCashFlow = $deleteCashFlow;
      }

    public function delete()
    {
        return $this->deleteCashFlow->execute();
    }
}
