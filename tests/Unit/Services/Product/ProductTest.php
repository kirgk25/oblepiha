<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Product;

use App\DTO\Products\CreateDTO;
use App\Services\Products\ProductService;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public ProductService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(ProductService::class);
    }

    public function test_store()
    {
        // Arrange
        // No arrange

        // Act
        $product = $this
            ->service
            ->store(
                CreateDTO::from([
                    'name' => 'product-1',
                    'description' => 'description-1',
                    'cost' => 123.45,
                    'photos' => [
                        [
                            'url' => 'http://example.com/first.jpg',
                        ],
                        [
                            'url' => 'http://example.com/second.jpg',
                        ],
                    ],
                ]),
            );

        // Assert
        $this->assertDatabaseHas(
            'products',
            [
                'name' => $product->name,
                'description' => $product->description,
                'cost' => $product->cost,
            ],
        );
        $this->assertDatabaseHas(
            'photos',
            [
                'product_id' => $product->id,
            ],
        );

        $this->assertCount(2, $product->photos);
        $this->assertEquals('http://example.com/first.jpg', $product->photos->first()->url);
        $this->assertEquals('http://example.com/second.jpg', $product->photos->last()->url);
    }
}
