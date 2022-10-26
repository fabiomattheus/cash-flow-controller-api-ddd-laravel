<?php

namespace Domain\Repositories;

use Domain\VOs\Contracts\IdVoInterface as Id;
use Domain\VOs\Contracts\TypeVoInterface as Type ;

interface HelpRepositoryInterface
{
    public function getAll($limit, $page, array $relations = null);
    public function lists($column, $key = null);
    public function findById(string $id, bool $fail = true);
    public function create(iterable $data);
    public function findOrFailVoWithRelations(Id $id, array $relations = null);
    public function findByCompositeKey(iterable $compositeId, iterable $columns = ['*']);
    public function update(iterable $data);
    public function delete(string $id);
    public function destroy(Id $id);
    public function findAllByType(Type $type, int $limit, int $page);
}