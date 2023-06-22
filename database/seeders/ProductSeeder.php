<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->insert([
        //     'product_name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);
        $productNames = [
            'Apple',
            'Banana',
            'Orange',
            'Milk',
            'Bread',
            'Eggs',
            'Chicken',
            'Beef',
            'Tomato',
            'Potato',
            'Onion',
            'Carrot',
            'Rice',
            'Pasta',
            'Cheese',
            'Yogurt',
            'Cereal',
            'Cucumber',
            'Broccoli',
            'Salmon',
            'Ice Cream',
            'Chocolate',
            'Coffee',
            'Tea',
            'Juice',
            'Water',
            'Soda',
            'Chips',
            'Cookies',
            'Candy'
        ];

        $products = [];
        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 4, 'prefix' => 'PC']);

        for ($i = 1; $i <= 20; $i++) {
            $products[] = [
                // 'id' => rand(49, 100),
                'product_name' => $productNames[rand(0, count($productNames) - 1)],
                'category_id' => rand(1, 11), // Assuming category IDs range from 1 to 5
                'supplier_id' => rand(1, 2), // Assuming supplier IDs range from 1 to 10
                'product_code' => $pcode,
                'product_store' => rand(1, 88),
                'buying_date' => Carbon::now()->subDays(rand(1, 365)),
                'expire_date' => Carbon::now()->addMonths(rand(1, 24)),
                'buying_price' => rand(10, 100) + (rand(0, 99) / 100), // Random buying price between 10.00 and 100.99
                'selling_price' => rand(20, 200) + (rand(0, 99) / 100), // Random selling price between 20.00 and 200.99
                'product_image' => 'upload/product/1768338355247467.jpg',
                'created_at' => Carbon::now()
            ];
        }

        DB::table('products')->insert($products);
    }
}
