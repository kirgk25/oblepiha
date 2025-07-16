<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexProductCollection extends ResourceCollection
{
    public $collects = IndexProductResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
