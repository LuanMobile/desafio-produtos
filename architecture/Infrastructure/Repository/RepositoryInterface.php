<?php

namespace Architecture\Infrastructure\Repository;

interface RepositoryInterface
{
    public function setCollectionName(string $collectionName): void;
    public function save(object $entity): ?object;
    public function update(int $id, $entity): ?bool;
    public function delete(int $id): ?bool;
    public function findById(int $id): ?object;
    public function findAll(array $fields): ?object;
}
