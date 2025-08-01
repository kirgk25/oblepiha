<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Favourite;
use App\Models\Product;

class FavouriteService extends BaseService
{
    public function store(Product $product): void
    {
        Favourite::insertOrIgnore([
            'user_id' => $this->getUserId(),
            'product_id' => $product->id,
        ]);

        $this->deleteFavouriteProductIdsFromCache();
    }

    public function delete(Product $product): void
    {
        Favourite::where([
            'user_id' => $this->getUserId(),
            'product_id' => $product->id,
        ])->limit(1)->delete();

        $this->deleteFavouriteProductIdsFromCache();
    }

    public function isFavouriteByProduct(Product $product): bool
    {
        $favouriteProductIds = $this->getFavouriteProductIdsFromCache();

        return isset($favouriteProductIds[$product->id]);
    }

    private function getFavouriteProductIdsFromCache(): array
    {
        $cacheKey = $this->getCacheKey();
        $favouriteProductIds = $this->cacheService->get($this->getCacheKey());

        if ($favouriteProductIds === null) {
            $favouriteProductIds = $this->getUser()
                ->favourites()
                ->select('product_id')
                ->pluck('product_id')
                ->flip()
                ->transform(function () {
                    return true;
                })->toArray();

            $this->cacheService->set($cacheKey, $favouriteProductIds, 600);
        }

        return $favouriteProductIds;
    }

    private function deleteFavouriteProductIdsFromCache(): void
    {
        $this->cacheService->delete($this->getCacheKey());
    }

    private function getCacheKey(): string
    {
        return sprintf('user.%s.favouriteProductIds', $this->getUserId());
    }
}
