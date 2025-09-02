<?php

declare(strict_types=1);

namespace App\Repositories\Products;

use App\DTO\Common\Sort\SortDTO;
use App\Models\Products\Product;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @extends BaseRepository<Product>
 */
final class ProductRepository extends BaseRepository
{
    public function getModel(): Product
    {
        return app(Product::class);
    }

    /**
     * @return LengthAwarePaginator<int, Product>
     */
    public function index(SortDTO $sortDTO): LengthAwarePaginator
    {
        return Product::query()
            ->sort($sortDTO)
            ->paginate(config('pagination.max_per_page'));
    }
}
