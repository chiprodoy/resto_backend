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

        /**
     * Get the post that owns the comment.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
class StatusOrder{
    const INORDER = 'inorder';
    const COOKING = 'cooking';
    const INVOICE = 'invoice';
}
