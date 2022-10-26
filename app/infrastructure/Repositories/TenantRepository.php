<?php

namespace Infrastructure\Repositories;

use Domain\Aggregates\Tenant;
use Infrastructure\Repositories\BaseRepository;
class TenantRepository extends BaseRepository
{
    //use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $modelClass = Tenant::class;



    }


