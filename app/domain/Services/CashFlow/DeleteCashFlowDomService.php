<?php

namespace Domain\Services\CashFlow;

use Illuminate\Support\Facades\App;

use Domain\Dto\Contracts\DtoInterface;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;
use Domain\VOs\Contracts\IdVoInterface;
use Presentation\Contracts\CashFlow\DeleteCashFlowDomServiceInterface;

class DeleteCashFlowDomService implements DeleteCashFlowDomServiceInterface
{
    protected $repository;

    public function __construct(
        Repository $repository,
    ) {
        $this->repository = $repository;
    }

    public function execute()
    {
        $this->repository->destroy(App::makeWith(IdVoInterface::class));
        return App::makeWith(DtoInterface::class)::toJson(200,'messages.success_delete_Cash_flow');
    }
}
