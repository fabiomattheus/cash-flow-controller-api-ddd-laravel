<?php

namespace Infrastructure\Repositories;


use Domain\Entities\Requester;
use Infrastructure\Repositories\BaseRepository;
use Domain\VOs\Contracts\IdVoInterface as Id;
class RequesterRepository extends BaseRepository
{
    //use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $modelClass = Requester::class;



    }


