<?php

namespace Application\Services\Help;

use Domain\Dto\Contracts\DtoInterface;
use Domain\Dto\Contracts\OtdInterface;
use Domain\Dto\Dto;
use Domain\Repositories\HelpRepositoryInterface as Repository;
use Illuminate\Support\Facades\DB;
use Presentation\Contracts\Help\CreateHelpInterface;
use Domain\Entities\Contracts\HelpEntityInterface as HelpEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class CreateHelp implements CreateHelpInterface
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
        $dto = App::makeWith(DtoInterface::class);
        DB::beginTransaction();
        $this->repository->create($dto::fromRequest($this->helpEntity));  
        DB::commit();
        return $dto::toJson(Response::HTTP_CREATED,'messages.success_create_help');
        unset($dto);
    }
}
