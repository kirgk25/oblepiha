<?php

declare(strict_types=1);

namespace App\Http\Resources\Products\Index;

use App\Models\Products\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class IndexProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cost' => $this->cost,
            'mainPhoto' => $this->mainPhoto,
            'isFavourite' => $this->isFavourite,
            'createdAt' => $this->created_at,
        ];
    }
}
