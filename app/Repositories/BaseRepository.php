<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @template TModel of Model
 */
abstract class BaseRepository
{
    abstract protected function getModel(): Model;

    /**
     * @return Builder<static>
     */
    protected function getQuery(): Builder
    {
        return $this
            ->getModel()
            ->newQuery();
    }

    public function deleteFirstWhere(array $attributes): bool
    {
        return (bool) $this
            ->getQuery()
            ->where($attributes)
            ->limit(1)
            ->delete();
    }

    public function insertOrIgnore(array $attributes): int
    {
        return $this->getQuery()->insertOrIgnore($attributes);
    }

    public function update(Model $model, array $attributes = [], array $options = []): bool
    {
        return $model->update($attributes, $options);
    }

    /**
     * @return TModel
     */
    public function create(array $attributes): Model
    {
        return $this->getQuery()->create($attributes);
    }

    /**
     * @return TModel
     */
    public function firstOrCreate(array $attributes = [], array $values = []): Model
    {
        return $this->getQuery()->firstOrCreate($attributes, $values);
    }

    /**
     * @return TModel
     */
    public function firstWhereOrFail(...$args): Model
    {
        $model = $this
            ->getQuery()
            ->firstWhere(
                ...func_get_args(),
            );
        if (null === $model) {
            throw new ModelNotFoundException();
        }

        return $model;
    }
}
