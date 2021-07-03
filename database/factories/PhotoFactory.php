<?php

namespace Database\Factories;

use App\Models;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Models\Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productIds = Models\Product::pluck('id');

        return [
            'product_id' => $this->faker->randomElement($productIds),
            'url' => $this->faker->url(),
        ];
    }
}
