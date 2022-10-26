<?php

namespace Domain\Repositories;

use Domain\VOs\Contracts\IdVoInterface as Id;


interface HelpRequestRepositoryInterface
{
    public function getAll($limit, $page, array $relations = null);
    public function lists($column, $key = null);
    public function findById(string $id, bool $fail = true);
    public function create(iterable $data);
    public function findOrFailVoWithRelations(Id $id, array $relations = null);
    public function findByCompositeKey(iterable $compositeId, iterable $columns = ['*']);
    public function getByIdentifier(String $identifier);
    public function createChatFilePaths(iterable $path);
    public function createPurchaseItem(iterable $data);
    public function update(iterable $data);
    public function delete(string $id);
    public function createChat(iterable $data);
    public function destroy(Id $id);
}
