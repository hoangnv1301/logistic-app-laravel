<?php

namespace App\Repositories;

use App\Models\Warehouse;
use App\Repositories\Contracts\WarehouseRepositoryContract;

class WarehouseRepository implements WarehouseRepositoryContract
{
    protected $model;

    public function __construct(Warehouse $model) {
        $this->model = $model;
    }

    public function paginate($data)
    {
        return $this->model->paginate($data);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        $warehouse = $this->model->find($id);
        $warehouse->product()->detach();
        return $this->model->destroy($id);
    }
}

