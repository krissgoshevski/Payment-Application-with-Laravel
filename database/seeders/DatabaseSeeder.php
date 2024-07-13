<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ProductSeeder::class(),


            Product::factory()->count(20)->create();
            Category::factory()->count(5)->create();

            $categories = Category::all();

            Product::all()->each(function ($product) use ($categories) {
                        // many to many relationship
                        $product->categories()->attach(
                            $categories->random(2)->pluck('id')->toArray(),
                        );
            });
    }
}
