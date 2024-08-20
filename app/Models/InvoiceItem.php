<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'uuid',
        'product_id',
        'item_name',
        'satuan',
        'price',
        'qty',
        'meja_id',
        'total_price',
        'status_order',
        'order_id',
        'invoice_id'
    ];

    public function setTotalPriceAttribute($value){
        $this->attributes['total_price'] = $this->price * $this->qty; //
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);

    }
}
