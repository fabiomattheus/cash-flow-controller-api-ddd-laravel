<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Help;
use Domain\Repositories\HelpRepositoryInterface;
use Infrastructure\Repositories\BaseRepository;
use Domain\VOs\Contracts\TypeVoInterface as Type;

class HelpRepository extends BaseRepository  implements HelpRepositoryInterface
{
    //use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $modelClass = Help::class;
 
    public function findAllByType(Type $type, int $limit, int $page)
    {
        $type = $type->toArray();
        $query = $this->newQuery();
        $query->where('type', $type['type']);
        return  $this->doQuery($query, $limit, $page, $paginate = true);
    }
}