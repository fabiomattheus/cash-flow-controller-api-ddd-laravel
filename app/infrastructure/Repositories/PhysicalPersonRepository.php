<?php

namespace Infrastructure\Repositories;


use Domain\Entities\PhysicalPerson;
use Infrastructure\Repositories\BaseRepository;

class PhysicalPersonRepository extends BaseRepository
{
    //use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $modelClass = PhysicalPerson::class;
}
