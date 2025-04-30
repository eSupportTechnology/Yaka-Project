<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ads')->insert([
            [
                'adsId' => 1,
                'user_id' => 1,
                'title' => 'iPhone 14 for Sale',
                'url' => Str::slug('iPhone 14 for Sale'),
                'location' => 1,
                'sublocation' => 2,
                'description' => 'A lightly used iPhone 14 in great condition.',
                'price' => 120000,
                'mainImage' => 'iphone14.jpg',
                'subImage' => json_encode(['img1.jpg', 'img2.jpg']),
                'cat_id' => 1,
                'sub_cat_id' => 2,
                'ads_package' => 1,
                'package_type' => 1,
                'package_expire_at' => now()->addDays(30),
                'bump_up_at' => now(),
                'view_count' => 10,
                'price_type' => 'fixed',
                'brand' => 'Apple',
                'model' => 'iPhone 14',
                'post_type' => 'sell',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adsId' => 2,
                'user_id' => 2,
                'title' => 'Toyota Aqua 2018',
                'url' => Str::slug('Toyota Aqua 2018'),
                'location' => 1,
                'sublocation' => 2,
                'description' => 'Well-maintained Toyota Aqua, full option.',
                'price' => 4500000,
                'mainImage' => 'aqua2018.jpg',
                'subImage' => json_encode(['img3.jpg', 'img4.jpg']),
                'cat_id' => 2,
                'sub_cat_id' => 3,
                'ads_package' => 1,
                'package_type' => 2,
                'package_expire_at' => now()->addDays(60),
                'bump_up_at' => now(),
                'view_count' => 50,
                'price_type' => 'negotiable',
                'brand' => 'Toyota',
                'model' => 'Aqua',
                'post_type' => 'sell',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // You can add more records similarly
        ]);
    }
}
