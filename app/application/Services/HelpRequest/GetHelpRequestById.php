<?php

namespace Application\Services\HelpRequest;
use Domain\Repositories\HelpRequestRepositoryInterface as Repository;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Support\Facades\App;
use Presentation\Contracts\HelpRequest\GetHelpRequestByIdInterface;

class GetHelpRequestById Implements GetHelpRequestByIdInterface
{
    protected $repository;
    protected $idVo;

    public function __construct(
      Repository $repository,
    )
    {
     $this->repository = $repository;
    }

    public function execute()
    {
        return $this->repository->findOrFailVoWithRelations(App::makeWith(IdVoInterface::class));
    }
}
