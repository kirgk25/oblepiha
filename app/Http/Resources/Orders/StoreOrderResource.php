<?php

declare(strict_types=1);

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreOrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'amount' => $this->amount,
        ];
    }
}
