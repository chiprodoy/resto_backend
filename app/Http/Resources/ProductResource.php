<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'uuid'=>$this->uuid,
            'product_name'=>$this->product_name,
            'price'=>$this->price,
            'stok_ada'=>$this->stok_ada,
            'product_image'=>$this->product_image

        ];
    }
}
