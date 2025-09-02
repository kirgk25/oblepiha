<?php

declare(strict_types=1);

namespace App\Http\Resources\Orders\Index;

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
