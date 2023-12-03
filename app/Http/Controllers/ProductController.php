<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    protected $repository;

    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function get()
    {
        try {
            $products = $this->repository->paginate(5);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Get products success',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function detail($id)
    {
        try {
            $product = $this->repository->find($id);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Get product success',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $data['supplier_id'] = $request->supplier_id;
            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $product = $this->repository->store($data);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Create product success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $data['supplier_id'] = $request->supplier_id;
            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $this->repository->update($id, $data);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Update product success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->repository->delete($id);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Delete product success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
