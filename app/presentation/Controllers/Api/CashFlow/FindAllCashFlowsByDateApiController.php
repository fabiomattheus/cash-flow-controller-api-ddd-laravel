<?php

namespace Presentation\Controllers\Api\CashFlow;

use App\Http\Controllers\Controller;
use Presentation\Contracts\CashFlow\FindAllCashFlowsByDateDomServiceInterface as FindAllCashFlowsByDate;

class FindAllCashFlowsByDateApiController extends Controller
{
    protected $findallCashFlowsByDate;

    public function __construct(
        FindAllCashFlowsByDate  $findallCashFlowsByDate,
    ) {
        $this->findallCashFlowsByDate = $findallCashFlowsByDate;
    }

    public function findAllByDate()
    {
        return $this->findallCashFlowsByDate->execute();
    }
}
