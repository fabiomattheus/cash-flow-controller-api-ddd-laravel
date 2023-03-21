<?php

namespace Domain\Services\CashFlow;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Application\Services\Contracts\CashFlow\AddCashFlowDomServiceInterface;
use Domain\Entities\Contracts\CashFlowEntityInterface as Entity;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;
use Domain\Dto\Contracts\DtoInterface;

class AddCashFlowDomService implements AddCashFlowDomServiceInterface
{
    protected $repository;
    protected $entity;
    protected $generateCode;
    protected $dto;

    public function __construct(
        Entity $entity,
        Repository $repository,
    ) {
        $this->entity = $entity;
        $this->repository = $repository;
    }

    public function execute(): void
    {
        $request = App::make(Request::class);
        $dto = App::makeWith(DtoInterface::class);
        $callBack = $this->repository->create($dto::fromRequest($this->entity));
        $cashFlowBalance = array_merge($request['CashFlowBalance'], ['cash_flow_id' => $callBack->id]);
        $request->merge(['CashFlowBalance' => $cashFlowBalance]);
        unset($dto, $callBack);
    }
}
