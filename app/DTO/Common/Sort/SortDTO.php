<?php

declare(strict_types=1);

namespace App\DTO\Common\Sort;

use App\DTO\BaseDTO;
use App\DTO\Common\Casts\ArrayCast;
use App\Enums\Common\Sort\SortDirectionEnum;
use Spatie\LaravelData\Attributes\WithCast;

class SortDTO extends BaseDTO
{
    /** @var SortElementDTO[] */
    public function __construct(
        #[WithCast(ArrayCast::class, class: SortElementDTO::class)]
        public array $sort = [],
    ) {}
}
