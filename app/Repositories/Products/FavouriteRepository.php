<?php

declare(strict_types=1);

namespace App\Repositories\Products;

use App\Models\Products\Favourite;
use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<Favourite>
 */
final class FavouriteRepository extends BaseRepository
{
    public function getProductIdsByUser(User $user): array
    {
        return $user
            ->favourites()
            ->select('product_id')
            ->pluck('product_id')
            ->toArray();
    }

    public function getModel(): Favourite
    {
        return app(Favourite::class);
    }
}
