<?php

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
            'createdAt' => $this->created_at,
        ];
    }
}
