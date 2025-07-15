<?php

namespace Tests\Feature\Product;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $user = User::factory()->createOne();

        // Act
        $this
            ->postJson('/api/products', [
                "name" => "product-1",
                "cost" => 123.45,
                "description" => "description-1",
                "photos"=> [
                    ["url" => "photo-1-1"],
                    ["url" => "photo-1-2"],
                    ["url" => "photo-1-3"],
                ],
            ])
            ->assertSuccessful();
        $this
            ->postJson('/api/products', [
                "name" => "product-2",
                "cost" => 223.45,
                "description" => "description-1",
                "photos"=> [
                    ["url" => "photo-2-1"],
                    ["url" => "photo-2-2"],
                    ["url" => "photo-2-3"],
                ],
            ])
            ->assertSuccessful();

        // Act
        $response = $this
            ->getJson('/api/products');

        // Assert
        $response
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    [
                        'name' => 'product-1',
                    ],
                    [
                        'name' => 'product-2',
                    ]
                ]
            ]);
    }
    
    public function testStore()
    {
        // Arrange
        $user = User::newModelInstance();

        // Act
        $response = $this
            ->postJson('/api/products', [
                "name" => "product-1",
                "cost" => 123.45,
                "description" => "description-1",
                "photos"=> [
                    ["url" => "photo-1-1"],
                    ["url" => "photo-1-2"],
                    ["url" => "photo-1-3"],
                ],
            ]);

        // Assert
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id'
                ]
            ]);
    }
}
