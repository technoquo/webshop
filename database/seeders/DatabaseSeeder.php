<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory(4)
        ->hasVariants(5)
        ->has(Image::factory()->count(3))
        ->afterCreating(function (Product $product) {
            $product->images->first()->update(['featured' => true]);
        })
        ->create();

        User::factory()->create([
            'email' => 'technoquo@gmail.com'
        ]);
    }
}
