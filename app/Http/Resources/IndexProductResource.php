<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mainPhoto' => $this->mainPhoto,
            'isFavourite' => $this->isFavourite,
            'createdAt' => $this->created_at,
        ];
    }
}
