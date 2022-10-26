<?php

namespace Infrastructure\Repositories;

use Domain\Aggregates\Contact;
use Infrastructure\Repositories\BaseRepository;

class ContactRepository extends BaseRepository
{
    //use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $modelClass = Contact::class;
}
