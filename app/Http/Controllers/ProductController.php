<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{   //TODO: refatorar codigo para implementar services e reporitories
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"          => ['required', 'string', 'max:255'],
            "description"   => ["nullable", "string"],
            "price"         => ["required", "numeric", "min:0"],
            "quantity"      => ["required", "integer", "min:1"]
        ]);
        if ($validator->fails()) {

            $errors = $validator->errors();
            return response()->json([
                'errors' => $errors->all(),
            ], 422);
        }

        try {
            $product = Product::create($validator->validated());

            if (!$product) {
                return response()->json(['error' => 'Failed to create product'], 500);
            }

            return response()->json([
                "status" => "success",
                "message" => "Product created successfully",
                "product" => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function update(int $id, Request $request)
    {    
        $validator = Validator::make($request->all(), [
            "name"          => ['nullable', 'string', 'max:255'],
            "description"   => ["nullable", "string"],
            "price"         => ["nullable", "numeric", "min:0"],
            "quantity"      => ["nullable", "integer", "min:1"],
            "active"        => ["nullable", "boolean"]
        ]);
        if ($validator->fails()) {

            $errors = $validator->errors();
            return response()->json([
                'errors' => $errors->all(),
            ], 422);
        }

        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $productUpdated = $product->update($validator->validated());

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
        $products = Product::all(['id', 'name', 'description', 'price', 'quantity', 'active']);

        if (!$products) {
            return response()->json(["error" => "There are no products"], 404);
        }

        return response()->json($products);
    }

    public function getProduct(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function delete(int $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
            $product->delete();
    
            return response()->json(['message' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
