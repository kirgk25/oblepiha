<?php

namespace App\Http\Resources\Order\Index;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexOrderCollection extends ResourceCollection
{
    public $collects = OrderResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
