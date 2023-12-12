<?php

namespace App\DTO\Product;

use App\DTO\BaseDTO;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;

class CreateDTO extends BaseDTO
{
    public readonly string $name;
    public readonly string $description;
    public readonly float $cost;

    /** @var PhotoDTO[] */
    #[CastWith(ArrayCaster::class, itemType: PhotoDTO::class)]
    public readonly array $photos;
}
