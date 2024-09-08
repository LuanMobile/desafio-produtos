<?php

namespace Architecture\Infrastructure\Repository;

class Repository implements RepositoryInterface
{
    public function __construct(
        protected RepositoryInterface $repository
    )
    {}

    public function setCollectionName(string $collectionName): void
    {
        $this->repository->setCollectionName($collectionName);
    }

    public function save(object $entity): bool
    {
        return $this->repository->save($entity);
    }

    public function update(object $entity): bool
    {
        return $this->repository->update($entity);
    }

    public function delete(object $entity): bool
    {
        return $this->repository->delete($entity);
    }

    public function findById(int $id): object
    {
        return $this->repository->findById($id);
    }

    public function findAll(): object
    {
        return $this->repository->findAll();
    }
}
