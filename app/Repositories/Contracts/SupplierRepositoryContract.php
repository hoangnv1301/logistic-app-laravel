<?php

namespace App\Repositories\Contracts;

interface SupplierRepositoryContract
{
    public function paginate($data);

    public function find($id);

    public function store($data);

    public function update($id, $data);

    public function delete($id);
}

