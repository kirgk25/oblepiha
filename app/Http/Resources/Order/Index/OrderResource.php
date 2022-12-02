<?php

namespace App\Http\Resources\Order\Index;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'number' => $this->number,
            'createdAt' => $this->created_at,
            'orderProducts' => OrderProductResource::collection($this->orderProducts),
        ];
    }
}
