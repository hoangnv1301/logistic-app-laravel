<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Repositories\Contracts\WarehouseRepositoryContract;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class WarehouseController extends BaseController
{
    protected $repository;

    public function __construct(WarehouseRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function get()
    {
        try {
            $warehouses = $this->repository->paginate(5);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Get warehouses success',
                'data' => $warehouses
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
            $warehouse = $this->repository->find($id);

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Get warehouse success',
                'data' => $warehouse
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(WarehouseRequest $request)
    {
        DB::beginTransaction();
        try {
            $data['name'] = $request->name;
            $data['address'] = $request->address;

            $warehouse = $this->repository->store($data);

            if ($request->product_id) {
                $arrProductId = $this->formatStringArray($request->product_id);
                $warehouse->product()->attach($arrProductId);
            }
            
            DB::commit();

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Create warehouse success',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(WarehouseRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data['name'] = $request->name;
            $data['address'] = $request->address;
            $this->repository->update($id, $data);

            if ($request->product_id) {
                $arrProductId = $this->formatStringArray($request->product_id);
                $warehouse = $this->repository->find($id);
                $warehouse->product()->sync($arrProductId);
            }

            DB::commit();

            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Update warehouse success',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

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
                'message' => 'Delete warehouse success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function formatStringArray($string)
    {
        $arrayOfStrings = explode(',', trim($string, '[]'));

        return array_map('intval', $arrayOfStrings);
    }
}

