<?php

namespace DOCore\DOQuot\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductQuotationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('doquot_product_quotation')->truncate();

        $product_quotation = [          
            ['product_id' => 1, 'quotation_id' => 1, 'unit_price' => 3, 'quantity' => 50],
            ['product_id' => 2, 'quotation_id' => 5, 'unit_price' => 1.5, 'quantity' => 30],
            ['product_id' => 3, 'quotation_id' => 2, 'unit_price' => 5, 'quantity' => 25,],
            ['product_id' => 4, 'quotation_id' => 4, 'unit_price' => 2.3,'quantity' => 50],
            ['product_id' => 1, 'quotation_id' => 3, 'unit_price' => 5, 'quantity' => 10],
        ];

        foreach ($product_quotation as $product) {
            DB::table('doquot_product_quotation')->insert([
                'product_id' => $product['product_id'],
                'quotation_id' => $product['quotation_id'],
                'unit_price' => $product['unit_price'],
                'quantity' => $product['quantity']
            ]);
        }
    }
}
