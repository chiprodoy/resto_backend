<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id'=>$this->product_id,
            'uuid'=>$this->uuid,
            'item_name'=>$this->item_name,
            'satuan'=>$this->satuan,
            'price'=>$this->price,
            'qty'=>$this->qty,
            'meja_id'=>$this->meja_id,
            'status_order'=>$this->status_order
        ];
    }
}
