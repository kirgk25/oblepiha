<?php

declare(strict_types=1);

namespace App\Builders;

use App\DTO\Common\Sort\SortDTO;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModel of BaseModel
 *
 * @extends Builder<TModel>
 *
 * @mixin BaseModel
 */
class BaseBuilder extends Builder
{
    public function sort(
        SortDTO $sortDTO,
    ): static {
        foreach ($sortDTO->sort as $sortElementDTO) {
            $this->orderBy(
                $sortElementDTO->fieldName,
                $sortElementDTO->direction->value,
            );
        }
        return $this;
    }
}
