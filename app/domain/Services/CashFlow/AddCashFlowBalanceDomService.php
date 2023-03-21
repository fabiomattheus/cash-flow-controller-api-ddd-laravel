<?php

namespace Domain\Services\CashFlow;

use Application\Services\Contracts\CashFlow\AddCashFlowBalanceDomServiceInterface;
use Domain\Aggregates\Contracts\CashFlowBalanceAggregateInterface as Entity;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;
use Illuminate\Support\Facades\App;
use Domain\Dto\Contracts\DtoInterface;

class AddCashFlowBalanceDomService implements AddCashFlowBalanceDomServiceInterface
{  
    protected $repository;
    protected $entity;
    protected $dto;

    public function __construct(
        Entity $entity,
        Repository $repository,
    ) {
        $this->repository = $repository;
        $this->entity = $entity;
    }

    public function execute() : void
    {
        $dto = App::makeWith(DtoInterface::class);
        $callBack = $this->repository->createBalance($dto::fromRequest($this->entity, true));
        unset($dto, $callBack);
    }
}
