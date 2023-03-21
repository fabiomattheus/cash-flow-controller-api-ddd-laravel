<?php

namespace Domain\Services\CashFlow;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Application\Services\Contracts\CashFlow\UpdateCashFlowBalanceDomServiceInterface;
use Domain\Aggregates\Contracts\CashFlowBalanceAggregateInterface as Entity;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;
use Domain\Dto\Contracts\DtoInterface;

class UpdateCashFlowBalanceDomService implements UpdateCashFlowBalanceDomServiceInterface
{
    protected $repository;
    protected $entity;
    protected $dto;

    public function __construct(
        Entity $entity,
        Repository $repository,
    ) {
        $this->entity = $entity;
        $this->repository = $repository;
   }

    public function execute()
    {
        $request = App::make(Request::class);
        $dto = App::makeWith(DtoInterface::class);
        $this->repository->updateBalance($dto::fromRequest($this->entity, true));
        unset($request, $dto);
    }
}
