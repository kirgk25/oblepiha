<?php

declare(strict_types=1);

namespace Feature\Product;

use App\Models\Products\Product;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class FavouriteTest extends TestCase
{
    public function test_store()
    {
        // Arrange
        $this
            ->postJson(route('products.index'), [
                "name" => "product-1",
                "cost" => 123.45,
                "description" => "description-1",
                "photos" => [
                    ["url" => "photo-1-1"],
                    ["url" => "photo-1-2"],
                    ["url" => "photo-1-3"],
                ],
            ])
            ->assertSuccessful();
        $this
            ->postJson(route('products.store'), [
                "name" => "product-2",
                "cost" => 223.45,
                "description" => "description-2",
                "photos" => [
                    ["url" => "photo-2-1"],
                    ["url" => "photo-2-2"],
                    ["url" => "photo-2-3"],
                ],
            ])
            ->assertSuccessful();
        $lastProductId = Product::query()->max('id');

        // Act
        $response = $this
            ->postJson(
                route(
                    'products.favourite.store',
                    ['product' => $lastProductId],
                ),
                [
                    "name" => "product-1",
                    "cost" => 123.45,
                    "description" => "description-1",
                    "photos" => [
                        ["url" => "photo-1-1"],
                        ["url" => "photo-1-2"],
                        ["url" => "photo-1-3"],
                    ],
                ],
            );

        // Assert
        $response->assertSuccessful();
        $this->assertDatabaseHas('favourites', [
            'product_id' => $lastProductId,
            'user_id' => $this->user->getKey(),
        ]);
    }
}
