<?php

namespace Tests\Unit\Services\Product;

use App\DTO\Product\CreateDTO;
use App\Services\ProductService;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public ProductService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(ProductService::class);
    }

    public function testStore()
    {
        $product = $this->service->store(new CreateDTO(
            name: 'plate',
            description: 'green plate',
            cost: 123.45,
            photos: [
                [
                    'url' => 'http://example.com/first.jpg',
                ],
                [
                    'url' => 'http://example.com/second.jpg',
                ],
            ],
        ));

        $this->assertDatabaseHas(
            'products',
            [
                'name' => $product->name,
                'description' => $product->description,
                'cost' => $product->cost,
            ]
        );
        $this->assertDatabaseHas(
            'photos',
            [
                'product_id' => $product->id,
            ]
        );

        $this->assertCount(2, $product->photos);
        $this->assertEquals('http://example.com/first.jpg', $product->photos->first()->url);
        $this->assertEquals('http://example.com/second.jpg', $product->photos->last()->url);
    }
}
