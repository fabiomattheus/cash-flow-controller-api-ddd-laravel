<?php

namespace Domain\Services\CashFlow;

use Illuminate\Support\Facades\App;

use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;
use Domain\VOs\Contracts\IdVoInterface;
use Presentation\Contracts\CashFlow\FindCashFlowByIdDomServiceInterface; 

class FindCashFlowByIdDomService implements FindCashFlowByIdDomServiceInterface
{
    protected $repository;
  
    public function __construct(
        Repository $repository,
    ) {
        $this->repository = $repository;
    }

    public function execute()
    {
        return $this->repository->findOrFailVoWithRelations(App::makeWith(IdVoInterface::class));
    }
}
