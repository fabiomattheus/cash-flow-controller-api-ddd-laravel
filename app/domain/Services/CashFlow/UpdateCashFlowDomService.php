<?php

namespace Domain\Services\CashFlow;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

use Application\Services\Contracts\CashFlow\UpdateCashFlowDomServiceInterface;
use Domain\Entities\Contracts\CashFlowEntityInterface as Entity;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;
use Domain\Dto\Contracts\DtoInterface;

class UpdateCashFlowDomService implements UpdateCashFlowDomServiceInterface
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
        try {
            $request = App::make(Request::class);
            $dto = App::makeWith(DtoInterface::class);
            $this->repository->update($dto::fromRequest($this->entity));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw $e;
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            unset($dto, $request);
        }
    }
}
