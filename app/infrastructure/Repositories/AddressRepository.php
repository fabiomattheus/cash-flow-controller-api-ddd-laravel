<?php

namespace Infrastructure\Repositories;

use Domain\Aggregates\Address;

use Infrastructure\Repositories\BaseRepository;

class AddressRepository extends BaseRepository
{
    //use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $modelClass = Address::class;
}
