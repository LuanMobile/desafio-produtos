<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Architecture\Application\ProductInputDTO;
use Architecture\Application\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }

    public function create(ProductRequest $request)
    {
        try {
            $productDTO = new ProductInputDTO(...$request->validated());
            $product = $this->productService->create($productDTO);

            return response()->json([
                "status" => "success",
                "message" => "Product created successfully",
                "product" => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => "Error creating product: " . $e->getMessage()], 500);
        }

    }

    public function update(int $id, UpdateProductRequest $request)
    {
        try {
            $product = $this->productService->findById($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
            $productUpdated = $this->productService->update($id, $request->validated());

            if (!$productUpdated) {
                return response()->json(['error' => 'Failed to update product'], 500);
            }

            return response()->json([
                "status" => "success",
                "message" => "Product updated successfully",
                "product" => $product
            ]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    public function listProducts()
    {
        $products = $this->productService->findAll(['id', 'name', 'description', 'price', 'quantity', 'active']);
        
        return response()->json($products);
    }

    public function getProduct(int $id)
    {
        $product = $this->productService->findById($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function delete(int $id)
    {
        try {
            $product = $this->productService->delete($id);
            if (!$product) {
                return response()->json(['error' => 'Error deleting product'], 500);
            }
    
            return response()->json(['message' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
