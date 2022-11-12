<?php namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Cache\CacheManager;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    private const CACHE_KEY_INDEX = 'product.index';

    /** @var Request */
    private $_request;

    /** @var CacheManager */
    private $_cache;

    public function __construct()
    {
        $this->_request = request();
        $this->_cache = cache();
    }

    private function _getRequestKey(): string
    {
        return md5(json_encode($this->_request->all()));
    }

    public function index(): LengthAwarePaginator
    {
        $cacheKey = self::CACHE_KEY_INDEX . '.' . $this->_getRequestKey();
        if (!$this->_cache->has($cacheKey)) {
            $products = Product::query();
            foreach ($this->_request->sort ?? [] as $field => $direction) {
                $products->orderBy($field, $direction);
            }

            $this->_cache->put($cacheKey, $products->paginate(PAGINATION_LIMIT), 600);
        }

        return $this->_cache->get($cacheKey);
    }


    public function update(Product $product): Product
    {
        $product->update($this->_request->all());
        $product->photos()->createMany($this->_request->photos);

        return $product;
    }

    public function store(): Product
    {
        $product = Product::create($this->_request->all());
        $product->photos()->createMany($this->_request->photos);

        return $product;
    }
}
