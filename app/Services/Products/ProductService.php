<?php

declare(strict_types=1);

namespace App\Services\Products;

use App\DTO\Common\Sort\SortDTO;
use App\DTO\Products\CreateDTO;
use App\DTO\Products\UpdateDTO;
use App\Enums\Common\Cache\CacheKeyIndexEnum;
use App\Models\Products\Product;
use App\Repositories\Products\PhotoRepository;
use App\Repositories\Products\ProductRepository;
use App\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

final class ProductService extends BaseService
{
    public const NAME_MAX_LENGTH = 200;
    public const DESCRIPTION_MAX_LENGTH = 1000;

    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly PhotoRepository $photoRepository,
    ) {
        parent::__construct();
    }

    public function index(SortDTO $sortDTO): LengthAwarePaginator
    {
        $cacheKey = CacheKeyIndexEnum::ProductIndex->value . '.' . $this->cacheHelper->getRequestKey();
        if (false === $this->cacheHelper->has($cacheKey)) {
            $products = $this
                ->productRepository
                ->index($sortDTO);

            $this->cacheHelper->set($cacheKey, $products, 600);
        }

        return $this->cacheHelper->get($cacheKey);
    }

    public function update(
        Product $product,
        UpdateDTO $updateDTO,
    ): Product {
        $productAttributes = $updateDTO
            ->only(
                'name',
                'description',
                'cost',
            )
            ->toArray();
        $this
            ->productRepository
            ->update(
                $product,
                $productAttributes,
            );

        $this
            ->photoRepository
            ->createManyByProduct(
                $product,
                $updateDTO->photos,
            );

        return $product;
    }

    public function store(CreateDTO $dto): Product
    {
        $product = $this
            ->productRepository
            ->create($dto->toArray());

        $this
            ->photoRepository
            ->createManyByProduct(
                $product,
                $dto->toArray()['photos'],
            );

        return $product;
    }
}
