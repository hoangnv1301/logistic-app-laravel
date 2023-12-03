<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryContract
{
    public function getAll();

    public function find($id);

    public function store($data);

    public function update($id, $data);

    public function delete($id);
}

