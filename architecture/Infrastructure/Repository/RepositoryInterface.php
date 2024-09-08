<?php

namespace Architecture\Infrastructure\Repository;

interface RepositoryInterface
{
    public function setCollectionName(string $collectionName): void;
    public function save(object $entity): bool;
    public function update(object $entity): bool;
    public function delete(object $entity): bool;
    public function findById(int $id): ?object;
    public function findAll(): ?object;
}
