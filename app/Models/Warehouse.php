<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    protected $fillable = [
        'name',
        'address',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [

    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_warehouse', 'warehouse_id', 'product_id');
    }
}
