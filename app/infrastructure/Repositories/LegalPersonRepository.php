<?php

namespace Infrastructure\Repositories;

use Domain\Entities\LegalPerson;

use Infrastructure\Repositories\BaseRepository;

class LegalPersonRepository extends BaseRepository
{
    //use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $modelClass = LegalPerson::class;
}
