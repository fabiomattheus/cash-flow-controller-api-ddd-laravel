<?php

namespace Application\Services\Help;

use Domain\Repositories\HelpRepositoryInterface as Repository;
use Domain\VOs\Contracts\TypeVoInterface;
use Illuminate\Support\Facades\App;
use Presentation\Contracts\Help\GetHelpsByTypeInterface;

class GetHelpsByType implements GetHelpsByTypeInterface
{
    protected $repository;
   
    public function __construct(
        Repository $repository,
    ) {
        $this->repository = $repository;
    }

    public function execute()
    {
        return $this->repository->findAllByType(App::makeWith(TypeVoInterface::class), 10, 1);
    }
}
