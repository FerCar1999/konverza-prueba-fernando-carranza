<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasUuids, SoftDeletes;

    protected $attributes = ['product_id', 'quantity', 'movement', 'description', 'movement_date'];
}
