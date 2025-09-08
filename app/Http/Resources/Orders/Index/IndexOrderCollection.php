<?php

declare(strict_types=1);

namespace App\Http\Resources\Orders\Index;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexOrderCollection extends ResourceCollection
{
    public $collects = OrderResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
