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

    public function save(object $entity): bool
    {
        $model = new $this->model((array)$entity);
        return $model->save();
    }

    public function update(object $entity): bool
    {
        $model = $this->model->find($entity->getId());
        return $model->update((array)$entity);
    }

    public function delete(object $entity): bool
    {
        $model = $this->model->find($entity->getId());
        return $model->delete();
    }

    public function findById(int $id): ?object
    {
        return $this->model->find($id);
    }

    public function findAll(): ?object
    {
        return $this->model->all();
    }
}
