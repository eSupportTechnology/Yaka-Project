<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'mainId' => 0,
                'free_add_count' => 3,
                'name' => 'Electronics',
                'url' => 'electronics',
                'description' => 'Devices and gadgets',
                'image' => 'electronics.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mainId' => 0,
                'free_add_count' => 2,
                'name' => 'Fashion',
                'url' => 'fashion',
                'description' => 'Clothing and accessories',
                'image' => 'fashion.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mainId' => 0,
                'free_add_count' => 1,
                'name' => 'Books',
                'url' => 'books',
                'description' => 'Books and literature',
                'image' => 'books.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mainId' => 0,
                'free_add_count' => 5,
                'name' => 'Home Appliances',
                'url' => 'home-appliances',
                'description' => 'Appliances for your home',
                'image' => 'appliances.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mainId' => 0,
                'free_add_count' => 4,
                'name' => 'Toys',
                'url' => 'toys',
                'description' => 'Toys and games for children',
                'image' => 'toys.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
