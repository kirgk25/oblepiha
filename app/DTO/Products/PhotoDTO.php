<?php

declare(strict_types=1);

namespace App\DTO\Products;

use App\DTO\BaseDTO;

class PhotoDTO extends BaseDTO
{
    public function __construct(
        public readonly string $url,
    ) {}
}
