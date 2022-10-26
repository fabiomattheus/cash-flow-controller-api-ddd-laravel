<?php

namespace Application\Services\Help;

use Domain\Dto\Contracts\DtoInterface;
use Domain\Repositories\HelpRepositoryInterface as Repository;
use Illuminate\Support\Facades\DB;
use Domain\Entities\Contracts\HelpEntityInterface as HelpEntity;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Presentation\Contracts\Help\UpdateHelpInterface;

class UpdateHelp implements UpdateHelpInterface
{
    protected $repository;
    protected $helpEntity;

    public function __construct(
        Repository $repository,
        HelpEntity $helpEntity

    ) {
        $this->repository = $repository;
        $this->helpEntity = $helpEntity;
    }

    public function execute()
    {
        DB::beginTransaction();
        $dto = App::makeWith(DtoInterface::class);
        App::makeWith(IdVoInterface::class);
        $this->repository->update($dto::fromRequest($this->helpEntity));
        DB::commit();
        return $dto::toJson(Response::HTTP_OK,'messages.success_update_help');
       unset($dto);
    }
}
