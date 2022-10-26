<?php

namespace Domain\Services\Requester;

use Domain\VOs\Contracts\IdVoInterface as IdVo;
use  Domain\Repositories\RequesterRepositoryInterface as Repository;
use Illuminate\Support\Facades\App;


class GetRequesterById
{
    protected $repository;
    protected $idVo;

    public function __construct(
        Repository $repository,
        IdVo $idVo

    ) {
        $this->repository = $repository;
        $this->idVo = $idVo;
    }

    public function execute()
    {
        return $this->repository->findWithValidation(App::makeWith($this->idVo));
    }
}
