<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Products\Product;
use App\Models\Products\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        Product::factory(30)->create();
        Photo::factory(50)->create();
    }
}
