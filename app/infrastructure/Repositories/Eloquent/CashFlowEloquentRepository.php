<?php

namespace Infrastructure\Repositories\Eloquent;

use Domain\Aggregates\CashFlowBalance;
use Domain\Entities\CashFlow;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface;
use Infrastructure\Repositories\Eloquent\BaseRepository;
use Domain\VOs\DateVo as Date;
use Domain\VOs\TypeVo as Type;
use Domain\VOs\Contracts\IdentifierVOInterface as Identifier;



class CashFlowEloquentRepository extends BaseRepository implements CashFlowEloquentRepositoryInterface
{

    protected $modelClass = CashFlow::class;

    public function createBalance(Iterable $data)
    {
        $this->setModel(CashFlowBalance::class);
        return $this->create($data);
    }

    public function updateBalance(Iterable $data)
    {
        $this->setModel(CashFlowBalance::class);
        return $this->update($data);
    }

    public function getByIdentifierVO(Identifier $identifier)
    {
        $identifier = $identifier->toArray();
        $query = $this->newQuery();
        $query->where('identifier', $identifier['identifier']);
        return  $this->doQuery($query);
    }

    public function getByIdentifier(String $identifier)
    {
        $query = $this->newQuery();
        $query->where('identifier', $identifier);
        return  $this->doQuery($query);
    }

    public function findAllByDate(Date $date, Type $type, int $limit, int $page)
    {
        $this->setModel(CashFlow::class); 
        $date = $date->toArray();
        $initialDate = $date['initialDate']; 
        $finalDate =  $date['finalDate'];  
        $type = $type->toArray();
        $query = $this->newQuery();
        $query->where('type', $type['type']);
        $query->whereBetween('movimentation_date', [$initialDate, $finalDate]);
        return  $this->doQuery($query, $limit, $page, $paginate = true);
    }
}
