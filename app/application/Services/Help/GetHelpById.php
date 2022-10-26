<?php

namespace Application\Services\Help;

use Domain\Repositories\HelpRepositoryInterface as Repository;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Support\Facades\App;
use Presentation\Contracts\Help\GetHelpByIdInterface;


class GetHelpById implements GetHelpByIdInterface
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
