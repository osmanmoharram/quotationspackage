<?php

namespace DOCore\DOQuot\Database\Seeders;

use DOCore\DOQuot\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('doquot_products')->truncate();

        $products = [
            ['id' => 1, 'name' => 'iphone 12', 'quantity' => 50, 'description' => 'mobile phone from apple'],
            ['id' => 2, 'name' => 'samsung galaxy fold', 'quantity' => 30, 'description' => 'mobile phone from samsung'],
            ['id' => 3, 'name' => 'dell inspiron 15', 'quantity' => 12, 'description' => 'dell laptop'],
            ['id' => 4, 'name' => 'lg 65 inch', 'quantity' => 50, 'description' => 'smart screen from lg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
