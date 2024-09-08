<?php

namespace Architecture\Application;

use Architecture\Infrastructure\Repository\Repository;

class ProductService
{
    public function __construct(
        protected Repository $repository
    )
    {}

    public function create(ProductInputDTO $product): ?object
    {
        $this->repository->setCollectionName('product');

        if (!$this->repository->save($product)) {
            throw new \Exception('Product cannot be created', 500);
        }

        return $this->repository->save($product);
    }

    public function update(int $id, $product): ?bool
    {
        $this->repository->setCollectionName('product');

        if (!$this->repository->update($id, $product)) {
            return response()->json(['error' => 'Product cannot be updated'], 500);
        }

        return $this->repository->update($id, $product);
    }

    public function findById(int $id): ?object
    {
        $this->repository->setCollectionName('product');

        return $this->repository->findById($id);
    }

    public function findAll(array $fields): ?object
    {
        $this->repository->setCollectionName('product');

        if (!$this->repository->findAll($fields)) {
            throw new \Exception("There are no products", 404);
        }

        return $this->repository->findAll($fields);
    }

    public function delete(int $id): ?bool
    {
        $this->repository->setCollectionName('product');
       
        return $this->repository->delete($id);
    }
}