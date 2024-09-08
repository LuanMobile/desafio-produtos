<?php

namespace Architecture\Infrastructure\Repository\Eloquent;

use Architecture\Infrastructure\Repository\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

class EloquentRepositoryStrategy implements RepositoryInterface
{
    protected array $collection;
    protected Model $model;

    public function setCollectionName(string $collectionName): void
    {
        $modelString = "App\\Models\\" . ucfirst($collectionName);

        if (false === class_exists($modelString)) {
            throw new Exception("Class {$modelString} doesn't exists");
        }

        $this->model = new $modelString();
    }

    public function save(object $entity): ?object
    {
        $model = $this->model::create((array)$entity);
    
        return $model;
    }

    public function update(int $id, $entity): ?bool
    {
        $model = $this->model->find($id);

        return $model->update((array)$entity);
    }

    public function delete(int $id): bool
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function findById(int $id): ?object
    {
        return $this->model->find($id);
    }

    public function findAll(array $fields): ?object
    {
        return $this->model->all($fields);
    }
}
