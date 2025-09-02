<?php

declare(strict_types=1);

namespace App\Services\Products;

use App\Models\Products\Product;
use App\Repositories\Products\FavouriteRepository;
use App\Services\BaseService;

final class FavouriteService extends BaseService
{
    public function __construct(
        private readonly FavouriteRepository $favouriteRepository,
    ) {
        parent::__construct();
    }

    public function store(Product $product): void
    {
        $this
            ->favouriteRepository
            ->insertOrIgnore([
                'user_id' => $this->getUserId(),
                'product_id' => $product->id,
            ]);

        $this->deleteFavouriteProductIdsFromCache();
    }

    public function delete(Product $product): void
    {
        $this
            ->favouriteRepository
            ->deleteFirstWhere([
                'user_id' => $this->getUserId(),
                'product_id' => $product->id,
            ]);

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
        $favouriteProductIds = $this->cacheHelper->get($this->getCacheKey());

        if (null === $favouriteProductIds) {
            $userProductIds = $this
                ->favouriteRepository
                ->getProductIdsByUser($this->getUser());

            $favouriteProductIds = collect($userProductIds)
                ->flip()
                ->transform(function () {
                    return true;
                })->toArray();

            $this->cacheHelper->set($cacheKey, $favouriteProductIds, 600);
        }

        return $favouriteProductIds;
    }

    private function deleteFavouriteProductIdsFromCache(): void
    {
        $this->cacheHelper->delete($this->getCacheKey());
    }

    private function getCacheKey(): string
    {
        return sprintf('user.%s.favouriteProductIds', $this->getUserId());
    }
}
