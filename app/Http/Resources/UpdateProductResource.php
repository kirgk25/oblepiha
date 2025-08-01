<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdateProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
        ];
    }
}
