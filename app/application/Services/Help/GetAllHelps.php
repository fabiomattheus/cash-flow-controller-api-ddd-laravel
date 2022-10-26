<?php

namespace Application\Services\Help;

use Domain\Repositories\HelpRepositoryInterface as Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Domain\Entities\Contracts\HelpEntityInterface as HelpEntity;
use Presentation\Contracts\Help\GetAllHelpsInterface;

class GetAllHelps implements GetAllHelpsInterface

{
    protected $repository;
    protected $helpEntity;

    public function __construct(

        Repository $repository,
        HelpEntity $helpEntity

    ) {
        $this->repository = $repository;
        $this->help = $helpEntity;
    }

    public function execute()
    {
        $request = App::make(Request::class);
        return $this->repository->getAll(10,$request->page);
     
    }
}
