<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasUuids, SoftDeletes;

    protected $attributes = ['name', 'description', 'price', 'img_url'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'product_id');
    }
}
