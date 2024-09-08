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

    public function save(object $entity): ?object
    {
        return $this->repository->save($entity);
    }

    public function update(int $id, $entity): ?bool
    {
        return $this->repository->update($id, $entity);
    }

    public function delete(int $id): ?bool
    {
        return $this->repository->delete($id);
    }

    public function findById(int $id): ?object
    {
        return $this->repository->findById($id);
    }

    public function findAll(array $fields): ?object
    {
        return $this->repository->findAll($fields);
    }
}
