<?php

declare(strict_types=1);

namespace App\Http\Resources\Orders\Index;

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
