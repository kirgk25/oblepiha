<?php

namespace App\Http\Resources\Order\Index;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'quantity' => $this->quantity,
            'product' => new ProductResource($this->product),
        ];
    }
}
