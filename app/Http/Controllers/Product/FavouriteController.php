<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\FavouriteService;

class FavouriteController extends Controller
{
    public function __construct(
        private FavouriteService $favouriteService,
    ) {}

    public function store(Product $product)
    {
        $this->favouriteService->store($product);
    }

    public function destroy(Product $product)
    {
        $this->favouriteService->delete($product);
    }
}
