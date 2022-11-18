<?php namespace App\Services\Product;

use App\Models\Product;
use App\Services\BaseService;
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
            foreach ($this->request->sort ?? [] as $field => $direction) {
                $products->orderBy($field, $direction);
            }

            $this->cacheService->set($cacheKey, $products->paginate(PAGINATION_LIMIT), 600);
        }

        return $this->cacheService->get($cacheKey);
    }

    public function update(Product $product): Product
    {
        $product->update($this->request->all());
        $product->photos()->createMany($this->request->photos);

        return $product;
    }

    public function store(): Product
    {
        $product = Product::create($this->request->all());
        $product->photos()->createMany($this->request->photos);

        return $product;
    }
}
