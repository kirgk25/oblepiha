<?php

declare(strict_types=1);

namespace App\DTO\Products;

use App\DTO\BaseDTO;

class UpdateDTO extends BaseDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly float $cost,
        public readonly array $photos,
    ) {}
}
