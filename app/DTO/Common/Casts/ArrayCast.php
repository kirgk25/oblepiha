<?php

declare(strict_types=1);

namespace App\DTO\Common\Casts;

use App\DTO\BaseDTO;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ArrayCast implements Cast
{
    public function __construct(
        private string $class,
    ) {}

    public function cast(
        DataProperty $property,
        mixed $value,
        array $properties,
        CreationContext $context,
    ): mixed {
        $result = [];
        foreach ($value as $parameters) {
            $result[] = is_a($this->class, BaseDTO::class, true)
                ? $this->class::from($parameters)
                : new $this->class(...$parameters);
        }

        return $result;
    }
}
