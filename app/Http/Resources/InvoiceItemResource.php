<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'invoice_id'=>$this->invoice_id,
            'product_id'=>$this->product_id,
            'item_name'=>$this->item_name,
            'satuan'=>$this->satuan,
            'price'=>$this->price,
            'qty'=>$this->qty,
            'total_price'=>$this->total_price,
            'status_order'=>$this->status_order,
            'invoice' => $this->invoice
        ];
    }
}
