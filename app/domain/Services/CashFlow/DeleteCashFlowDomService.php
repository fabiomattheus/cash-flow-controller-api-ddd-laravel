<?php

namespace Domain\Services\CashFlow;

use Illuminate\Support\Facades\App;

use Domain\Dto\Contracts\DtoInterface;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Http\Request;
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
        $request = App::make(Request::class); 
        try {
            $idVO =  App::makeWith(IdVoInterface::class);
            $id = $idVO->toArray();
            $this->repository->findById($id['id'], true);
            $this->repository->deleteBalance($idVO);
            $this->repository->destroy($idVO);
            return App::makeWith(DtoInterface::class)::toJson(200, 'messages.success_delete_Cash_flow');
            unset($id, $idVO, $request);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw $e;
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            unset($cashFlow, $id, $idVO, $request);
        }
    }
}
