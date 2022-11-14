<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreTokenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'token' => $this,
        ];
    }
}
