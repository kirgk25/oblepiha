<?php

declare(strict_types=1);

namespace App\DTO\Common\Sort;

use App\DTO\BaseDTO;
use App\Enums\Common\Sort\SortDirectionEnum;
use Spatie\LaravelData\Casts\EnumCast;

class SortElementDTO extends BaseDTO
{
    public function __construct(
        public ?string $fieldName = null,
        #[WithCast(EnumCast::class)]
        public ?SortDirectionEnum $direction = null,
    ) {}
}
