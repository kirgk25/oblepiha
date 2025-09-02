<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Services\Products\FavouriteService;
use Illuminate\Http\Response;

class FavouriteController extends Controller
{
    public function __construct(
        private FavouriteService $favouriteService,
    ) {}

    public function store(Product $product): Response
    {
        $this->favouriteService->store($product);
        return response()->noContent();
    }

    public function destroy(Product $product): Response
    {
        $this->favouriteService->delete($product);
        return response()->noContent();
    }
}
