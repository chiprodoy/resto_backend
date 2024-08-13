<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends MainModel
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'invoice_number',
        'costumer_id',
        'meja_id',
        'costumer_name',
        'costumer_address',
        'merchant_id',
        'subtotal',
        'percent_tax',
        'tax_amount',
        'percent_amount',
        'discount_amount',
        'total',
        'status_pembayaran',
        'tgl_jatuh_tempo',
        'pic',
        'jenis_transaksi',
        'metode_pembayaran'
    ];

    public function setTotalPriceAttribute($value){
        $this->attributes['total_price'] = $this->price * $this->qty; //
    }

    public function setPercentTaxAttribute($value){
        $this->attributes['percent_tax'] = $this->price * $this->qty; //
    }

    public function setInvoiceNumberAttribute($value){
        $lastInvoice = Invoice::count();
        if($lastInvoice>0)  $this->attributes['invoice_number'] = 'INV-' .str_pad((int) $lastInvoice + 1, 4, '0', STR_PAD_LEFT);
        else $this->attributes['invoice_number'] = 'INV-'.str_pad(1, 4, '0', STR_PAD_LEFT);

    }

    public function invoice_item(){
        return $this->hasMany(InvoiceItem::class);

    }

}
