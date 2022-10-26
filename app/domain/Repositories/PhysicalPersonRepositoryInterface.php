<?php

namespace Domain\Repositories;

use Domain\VOs\Contracts\IdVoInterface;
use Domain\VOs\IdVo as Id;

interface PhysicalPersonRepositoryInterface
{
    public function getAll($limit, $page, array $relations = null);
    public function lists($column, $key = null);
    public function findByID($id, $fail = true);
    public function create(iterable $data);
    public function find($id, array $relations = null);
    public function findWithValidation(IdVoInterface $id, array $relations = null);
    public function findByCompositeKey(iterable $compositeId, iterable $columns = ['*']);
    public function update(iterable $data);
    public function delete($id);
    public function createChat(iterable $data);
    public function createChatImages(iterable $data);
    public function createRequest(iterable $data);
    public function destroy(Id $id);
}
