<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'invoice_number'=>$this->invoice_number,
            'costumer_id' => $this->costumer_id,
            'meja_id' => $this->meja_id,
            'costumer_name'=>$this->costumer_name,
            'costumer_address'=>$this->costumer_address,
            'merchant_id' => $this->merchant_id,
            'subtotal'=> $this->subtotal,
            'percent_tax'=>$this->percent_tax,
            'tax_amount'=>$this->tax_amount,
            'percent_amount'=>$this->percent_amount,
            'discount_amount'=>$this->discount_amount,
            'total'=>$this->discount_amount,
            'status_pembayaran'=>$this->status_pembayaran,
            'tgl_jatuh_tempo'=>$this->tgl_jatuh_tempo,
            'pic'=>$this->pic,
            'jenis_transaksi'=>$this->jenis_transaksi,
            'metode_pembayaran'=>$this->metode_pembayaran,
            'invoice_item'=>$this->invoice_item
        ];
    }
}
