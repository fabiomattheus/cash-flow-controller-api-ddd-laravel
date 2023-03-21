<?php

namespace Presentation\Controllers\Api\CashFlow;

use App\Http\Controllers\Controller;
use Presentation\Contracts\CashFlow\FindCashFlowByIdDomServiceInterface as FindCashFlowById;

class FindCashFlowByIdApiController extends Controller
{
    protected $findCashFlowbyid;

    public function __construct(
        FindCashFlowById  $findCashFlowbyid
    ) {
        $this->findCashFlowbyid = $findCashFlowbyid;
    }

    public function findById()
    {
        return $this->findCashFlowbyid->execute();
    }
}
