<?php

namespace Application\Services\Help;

use Domain\Dto\Contracts\DtoInterface;
use Domain\Repositories\HelpRepositoryInterface as Repository;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Presentation\Contracts\Help\DeleteHelpInterface;

class DeleteHelp implements DeleteHelpInterface
{
    protected $repository;

    public function __construct(
        Repository $repository,
    ) {
        $this->repository = $repository;
    }

    public function execute()
    {
        DB::beginTransaction();
        $this->repository->destroy(App::makeWith(IdVoInterface::class));
        DB::commit();
        return App::makeWith(DtoInterface::class)::toJson(Response::HTTP_OK,'messages.success_delete_help');
    }
}
