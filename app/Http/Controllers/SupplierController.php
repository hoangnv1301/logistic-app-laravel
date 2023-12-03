<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Repositories\Contracts\SupplierRepositoryContract;
use Illuminate\Routing\Controller as BaseController;

class SupplierController extends BaseController
{
    protected $repository;

    public function __construct(SupplierRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function get()
    {
        try {
            $suppliers = $this->repository->paginate(5);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Get suppliers success',
                'data' => $suppliers
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
            $supplier = $this->repository->find($id);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Get supplier success',
                'data' => $supplier
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(SupplierRequest $request)
    {
        try {
            $data['name'] = $request->name;
            $data['address'] = $request->address;
            $supplier = $this->repository->store($data);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Create supplier success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(SupplierRequest $request, $id)
    {
        try {
            $data['name'] = $request->name;
            $data['address'] = $request->address;
            $this->repository->update($id, $data);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Update supplier success',
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
                'message' => 'Delete supplier success',
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
