<?php

declare(strict_types=1);

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cost' => $this->cost,
            // main photo
            'mainPhoto' => $this->mainPhoto,
            // other photos
            'photos' => $this->when(in_array('photos', $request->fields ?? []), function () {
                return $this->photos;
            }),
            'description' => $this->when(in_array('description', $request->fields ?? []), function () {
                return $this->description;
            }),
        ];
    }
}
