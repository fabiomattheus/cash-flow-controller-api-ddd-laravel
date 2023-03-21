<?php

namespace Domain\Repositories\Eloquent;

use Domain\VOs\IdVo as Id;
use Domain\VOs\DateVo as Date;
use Domain\VOs\TypeVo as Type;
use Domain\VOs\IdentifierVO as Identifier;

interface CashFlowEloquentRepositoryInterface
{
    public function getModel();
    public function setModel($model);
    public function getAll($limit, $page, array $relations = null);
    public function lists($column, $key = null);
    public function findById(String $id, bool $fail = false);
    public function create(iterable $data);   
    public function findOrFailWithRelations($id, array $relations = null);
    public function findOrFailVoWithRelations(Id $id, array $relations = null);
    public function findByCompositeKey(string $compositeId, iterable $columns = ['*']); 
    public function update(iterable $data);
    public function delete(String $id);
    public function destroy(Id $id);
    public function createBalance(Iterable $data);
    public function updateBalance(Iterable $data);
    public function getByIdentifierVO(Identifier $identifier);
    public function getByIdentifier(String $identifier);
    public function findAllByDate(Date $date, Type $type, int $limit, int $page);

}





