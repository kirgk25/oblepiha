<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productIds = Product::pluck('id');

        return [
            'product_id' => $this->faker->randomElement($productIds),
            'url' => $this->faker->url(),
        ];
    }
}
