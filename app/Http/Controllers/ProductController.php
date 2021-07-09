<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexProductCollection;
use App\Http\Resources\ShowProductResource;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\IndexProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\UpdateProductResource;
use App\Http\Resources\StoreProductResource;

class ProductController extends Controller
{
    /** @var ProductService */
    private $_productService;

    public function __construct(ProductService $productService)
    {
        $this->_productService = $productService;
    }

    public function index(IndexProductRequest $request)
    {
        return new IndexProductCollection($this->_productService->index());
    }

    public function store(StoreProductRequest $request)
    {
        return new StoreProductResource($this->_productService->store());
    }

    public function show(Product $product)
    {
        return new ShowProductResource($product);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        return new UpdateProductResource($this->_productService->update($product));
    }
}
