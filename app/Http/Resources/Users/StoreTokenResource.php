<?php

declare(strict_types=1);

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin bool
 */
class StoreTokenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'token' => $this->resource,
        ];
    }
}
