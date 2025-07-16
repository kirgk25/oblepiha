<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Product\CreateDTO;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

use const PAGINATION_LIMIT;

class ProductService extends BaseService
{
    private const CACHE_KEY_INDEX = 'product.index';

    public function index(): LengthAwarePaginator
    {
        $cacheKey = self::CACHE_KEY_INDEX . '.' . $this->cacheService->getRequestKey();
        if (!$this->cacheService->has($cacheKey)) {
            $products = Product::query();
            foreach (request()->sort ?? [] as $field => $direction) {
                $products->orderBy($field, $direction);
            }

            $this->cacheService->set($cacheKey, $products->paginate(PAGINATION_LIMIT), 600);
        }

        return $this->cacheService->get($cacheKey);
    }

    public function update(Product $product): Product
    {
        $product->update(request()->all());
        $product->photos()->createMany(request()->photos);

        return $product;
    }

    public function store(CreateDTO $dto): Product
    {
        $product = Product::create($dto->toArray());

        $product->photos()->createMany(
            $dto->toArray()['photos']
        );

        return $product;
    }
}
