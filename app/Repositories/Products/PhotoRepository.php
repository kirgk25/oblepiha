<?php

declare(strict_types=1);

namespace App\Repositories\Products;

use App\Models\Products\Photo;
use App\Models\Products\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<Photo>
 */
final class PhotoRepository extends BaseRepository
{
    public function getModel(): Photo
    {
        return app(Photo::class);
    }

    /**
     * @return Collection<int, Photo>
     */
    public function createManyByProduct(Product $product, array $attributes): Collection
    {
        return $product
            ->photos()
            ->createMany($attributes);
    }
}
