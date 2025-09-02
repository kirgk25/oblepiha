<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\DTO\Products\CreateDTO;
use App\DTO\Products\UpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\Index\IndexProductCollection;
use App\Http\Resources\Products\ShowProductResource;
use App\Models\Products\Product;
use App\Services\Products\ProductService;
use App\Http\Requests\Products\IndexProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Resources\Products\UpdateProductResource;
use App\Http\Resources\Products\StoreProductResource;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(IndexProductRequest $request): IndexProductCollection
    {
        $sortDTO = $request->toSortDTO();

        return IndexProductCollection::make($this->productService->index($sortDTO));
    }

    public function store(StoreProductRequest $request): StoreProductResource
    {
        return StoreProductResource::make(
            $this->productService->store(
                CreateDTO::from($request->validated()),
            ),
        );
    }

    public function show(Product $product): ShowProductResource
    {
        return ShowProductResource::make($product);
    }

    public function update(Product $product, UpdateProductRequest $request): UpdateProductResource
    {
        return UpdateProductResource::make(
            $this->productService->update(
                $product,
                UpdateDTO::from($request->validated()),
            ),
        );
    }
}
