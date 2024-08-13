<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends MainModel
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'product_id',
        'item_name',
        'satuan',
        'price',
        'qty',
        'meja_id',
        'status_order'
    ];
}
