<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use App\Models\Products\Photo;
use App\Models\Products\Product;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_index()
    {
        // Arrange
        $this
            ->postJson(route('products.store'), [
                'name' => 'product-1',
                'cost' => 123.45,
                'description' => 'description-1',
                'photos' => [
                    ['url' => 'photo-1-1'],
                    ['url' => 'photo-1-2'],
                    ['url' => 'photo-1-3'],
                ],
            ])
            ->assertSuccessful();
        $this
            ->postJson(route('products.store'), [
                'name' => 'product-2',
                'cost' => 223.45,
                'description' => 'description-2',
                'photos' => [
                    ['url' => 'photo-2-1'],
                    ['url' => 'photo-2-2'],
                    ['url' => 'photo-2-3'],
                ],
            ])
            ->assertSuccessful();

        // Act
        $response = $this
            ->getJson(route('products.index'));

        // Assert
        $response
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    [
                        'name' => 'product-1',
                        'mainPhoto' => 'photo-1-1',
                        'isFavourite' => false,
                    ],
                    [
                        'name' => 'product-2',
                        'mainPhoto' => 'photo-2-1',
                        'isFavourite' => false,
                    ],
                ],
            ]);
    }

    #[DataProvider('data_index_sort')]
    public function test_index_sort(
        array $products,
        array $requestParameters,
        array $expectedStructure,
    ) {
        // Arrange
        foreach ($products as $product) {
            $product = array_merge(
                $product,
                [
                    'photos' => [
                        ['url' => 'photo-1'],
                        ['url' => 'photo-2'],
                        ['url' => 'photo-3'],
                    ],
                ],
            );
            $this
                ->postJson(route('products.store'), $product)
                ->assertSuccessful();
        }

        // Act
        $response = $this
            ->getJson(route('products.index', $requestParameters));

        // Assert
        $responseProducts = $response->json('data');
        $actualStructure = [];
        foreach ($responseProducts as $responseProduct) {
            $actualStructure[] = $responseProduct['name'];
        }
        $this->assertEquals($expectedStructure, $actualStructure);
    }

    public static function data_index_sort(): array
    {
        return [
            'caseSortByCostDesc' => [
                'products' => [
                    [
                        'name' => 'product-1',
                        'cost' => 5.70,
                        'description' => 'description-4',
                    ],
                    [
                        'name' => 'product-2',
                        'cost' => 1.25,
                        'description' => 'description-5',
                    ],
                    [
                        'name' => 'product-3',
                        'cost' => 3.33,
                        'description' => 'description-1',
                    ],
                ],
                'requestParameters' => [
                    'sort' => [
                        [
                            'fieldName' => 'cost',
                            'direction' => 'desc',
                        ],
                    ],
                ],
                'expectedStructure' => [
                    'product-1',
                    'product-3',
                    'product-2',
                ],
            ],
            'caseSortByDescriptionDescAndCostAsc' => [
                'products' => [
                    [
                        'name' => 'product-1',
                        'cost' => 100.00,
                        'description' => 'description-4',
                    ],
                    [
                        'name' => 'product-2',
                        'cost' => 123.45,
                        'description' => 'description-5',
                    ],
                    [
                        'name' => 'product-3',
                        'cost' => 500.00,
                        'description' => 'description-1',
                    ],
                    [
                        'name' => 'product-4',
                        'cost' => 700.15,
                        'description' => 'description-1',
                    ],
                    [
                        'name' => 'product-5',
                        'cost' => 123.45,
                        'description' => 'description-1',
                    ],
                ],
                'requestParameters' => [
                    'sort' => [
                        [
                            'fieldName' => 'description',
                            'direction' => 'desc',
                        ],
                        [
                            'fieldName' => 'cost',
                            'direction' => 'asc',
                        ],
                    ],
                ],
                'expectedStructure' => [
                    'product-2',
                    'product-1',
                    'product-5',
                    'product-3',
                    'product-4',
                ],
            ],
        ];
    }

    public function test_store()
    {
        // Arrange
        // No arrange

        // Act
        $response = $this
            ->postJson(route('products.store'), [
                'name' => 'product-1',
                'cost' => 123.45,
                'description' => 'description-1',
                'photos' => [
                    ['url' => 'photo-1-1'],
                    ['url' => 'photo-1-2'],
                    ['url' => 'photo-1-3'],
                ],
            ]);

        // Assert
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                ],
            ]);
    }

    public function test_update()
    {
        // Arrange
        $this
            ->postJson(route('products.store'), [
                'name' => 'product-1',
                'cost' => 123.45,
                'description' => 'description-1',
                'photos' => [
                    ['url' => 'photo-1-1'],
                    ['url' => 'photo-1-2'],
                    ['url' => 'photo-1-3'],
                ],
            ]);
        $productId = $this
            ->postJson(route('products.store'), [
                'name' => 'product-2',
                'cost' => 223.45,
                'description' => 'description-2',
                'photos' => [
                    ['url' => 'photo-2-1'],
                    ['url' => 'photo-2-2'],
                    ['url' => 'photo-2-3'],
                ],
            ])
            ->json('data.id');

        // Act
        $response = $this
            ->patchJson(
                route('products.update', ['product' => $productId]),
                [
                    'name' => 'new-name',
                    'cost' => 777,
                    'description' => 'new-description',
                    'photos' => [
                        ['url' => 'photo-one'],
                        ['url' => 'photo-two'],
                        ['url' => 'photo-three'],
                    ],
                ],
            );

        // Assert
        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                ],
            ]);

        $this->assertDatabaseCount(Product::getTableName(), 2);
        $this->assertDatabaseHas(
            Product::getTableName(),
            [
                'id' => $productId,
                'name' => 'new-name',
                'cost' => 777,
                'description' => 'new-description',
            ],
        );

        $this->assertDatabaseCount(Photo::getTableName(), 9);
        $this->assertDatabaseHas(
            Photo::getTableName(),
            ['product_id' => $productId, 'url' => 'photo-2-1'],
        );
        $this->assertDatabaseHas(
            Photo::getTableName(),
            ['product_id' => $productId, 'url' => 'photo-2-2'],
        );
        $this->assertDatabaseHas(
            Photo::getTableName(),
            ['product_id' => $productId, 'url' => 'photo-2-3'],
        );
        $this->assertDatabaseHas(
            Photo::getTableName(),
            ['product_id' => $productId, 'url' => 'photo-one'],
        );
        $this->assertDatabaseHas(
            Photo::getTableName(),
            ['product_id' => $productId, 'url' => 'photo-two'],
        );
        $this->assertDatabaseHas(
            Photo::getTableName(),
            ['product_id' => $productId, 'url' => 'photo-three'],
        );
    }
}
