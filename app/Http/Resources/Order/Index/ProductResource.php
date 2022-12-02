<?php

namespace App\Http\Resources\Order\Index;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mainPhoto' => $this->mainPhoto,
        ];
    }
}
