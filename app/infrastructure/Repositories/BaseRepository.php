<?php

namespace Infrastructure\Repositories;

use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Cache;
use Domain\VOs\Contracts\IdVoInterface as Id;
use ReflectionClass;

abstract class BaseRepository
{
    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass;
    /**
     * @return EloquentQueryBuilder|QueryBuilder
     */

    protected function doQuery($query = null, int $take = null, int $page = null, bool $paginate = null, array $columns = null, String $pageName = null)
    {
        $paginate = $paginate ?? false;
        $columns = $columns ?? ['*'];

        if (is_null($query)) {
            $query = $this->newQuery();
        } elseif (is_null($page) && $paginate) {
            abort(response()->json(['errors' => trans('messages.error_failed_paginate')], 404));
        } elseif (is_null($take) && !$paginate) {
            return $query->first();
        } elseif ($paginate) {
            return $query->paginate($take, $columns, $pageName, $page);
        } elseif ($take > 0 || false !== $take) {
            $query->take($take);
        }
        return $query->get();
    }

    protected function newQuery()
    {
        return app($this->modelClass)->newQuery();
    }

    public function getModel()
    {
        return app($this->modelClass);
    }

    public function setModel($model)
    {
        $this->modelClass = $model;
        return app($this->modelClass);
    }


    public function getAll($limit, $page, array $relations = null)
    {
        $relations = $relations ?? [];
        $reflection = new ReflectionClass($this->getModel());
        $expiration = 60;
        $key = 'all' . $reflection->getShortName() . $page;
        return Cache::remember($key, $expiration, function () use ($limit, $page, $relations) {
            $query = $this->newQuery()->with($relations);
            return  $this->doQuery($query, $limit, $page, $paginate = true);
        });
    }

    public function lists($column, $key = null)
    {
        return $this->newQuery()->lists($column, $key);
    }

    public function findById(String $id, bool $fail = false)
    {
        if ($fail) {
            return $this->newQuery()->findOrFail($id);
        }
        return $this->newQuery()->find($id);
    }

    public function create(iterable $data)
    {
        return $this->newQuery()->create($data);
    }

    public function findOrFailWithRelations($id, array $relations = null)
    {
        $relations = $relations ?? [];
        return $this->newQuery()->findOrFail($id)->load($relations);
    }

    public function findOrFailVoWithRelations(Id $id, array $relations = null)
    {
        $id = $id->toArray();
        $relations = $relations ?? [];
        return $this->newQuery()->findOrFail($id['id'])->load($relations);
    }

    public function findByCompositeKey(iterable $compositeId, iterable $columns = ['*'])
    {
        $ids = explode(',', $compositeId);
        $query = $this->newQuery();
        foreach ($ids as $index => $key) {
            $query->where($key, '=', $ids[$index]);
        }
        return $query->first($columns);
    }

    public function update(iterable $data)
    {
        $query = $this->newQuery();
        $query->where('id', $data['id']);
        return $query->update($data);
    }

    public function delete(String $id)
    {
        $query = $this->newQuery();
        $query->where('id', $id);
        return $query->delete();
    }

    public function destroy(Id $id)
    {
        $id = $id->toArray();
        $query = $this->newQuery();
        $query->where('id', $id['id']);
        return $query->delete();
    }
}
