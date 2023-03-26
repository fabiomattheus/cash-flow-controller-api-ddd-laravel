<?php

namespace Domain\Services\CashFlow;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;
use Domain\VOs\Contracts\DateVOInterface;
use Domain\VOs\Contracts\TypeVoInterface;
use Domain\Entities\Contracts\CashFlowEntityInterface as Entity;
use Presentation\Contracts\CashFlow\FindAllCashFlowsByDateDomServiceInterface;

class FindAllCashFlowsByDateDomService implements FindAllCashFlowsByDateDomServiceInterface

{
    protected $repository;
    protected $entity;

    public function __construct(

        Repository $repository,
        Entity $entity

    ) {
        $this->repository = $repository;
        $this->entity = $entity;
    }

    public function execute()
    {
        $request = App::make(Request::class);
        try {
            $dateVO =  App::makeWith(DateVOInterface::class);
            $typeVO =  App::makeWith(TypeVoInterface::class);    
            return $this->repository->findAllByDate($dateVO, $typeVO, 10, $request->page);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            unset($typeVO, $dateVO, $request);
        }
    }
}
