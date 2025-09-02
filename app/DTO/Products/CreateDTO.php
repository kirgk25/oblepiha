<?php

declare(strict_types=1);

namespace App\DTO\Products;

use App\DTO\BaseDTO;
use App\DTO\Common\Casts\ArrayCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\IterableItemCast;

class CreateDTO extends BaseDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly float $cost,

        /** @var PhotoDTO[] */
        #[WithCast(ArrayCast::class, class: PhotoDTO::class)]
        public readonly array $photos,
    ) {}
}
