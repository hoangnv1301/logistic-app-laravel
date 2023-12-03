<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

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
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }
}
