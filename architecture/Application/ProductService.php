<?php

namespace Architecture\Application;

use Architecture\Infrastructure\Repository\Repository;

class ProductService
{
    public function __construct(
        protected Repository $repository
    )
    {}

    public function create(ProductInputDTO $product): void
    {
        $this->repository->setCollectionName('product');

        if (false === $this->repository->save($product)) {
            throw new \Exception('Product cannot be created', 500);
        }
    }

    public function update(ProductInputDTO $product): void
    {
        $this->repository->setCollectionName('product');

        if (false === $this->repository->update($product)) {
            throw new \Exception('Product cannot be updated', 500);
        }
    }

    public function findById(int $id): object
    {
        $this->repository->setCollectionName('product');

        return $this->repository->findById($id);
    }

    public function findAll(): object
    {
        $this->repository->setCollectionName('product');

        return $this->repository->findAll();
    }
}