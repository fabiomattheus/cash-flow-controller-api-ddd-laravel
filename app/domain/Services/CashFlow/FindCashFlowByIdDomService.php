<?php

namespace Domain\Services\CashFlow;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

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
       
        try {
            $request = App::make(Request::class);
            $idVO = App::makeWith(IdVoInterface::class);
            $id = $idVO->toArray();
            return $this->repository->findById($id['id'], true);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw $e;
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            unset($idVO, $request);
        }
    }
}
