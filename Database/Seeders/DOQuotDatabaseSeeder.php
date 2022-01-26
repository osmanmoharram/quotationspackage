<?php

namespace DOCore\DOQuot\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DOQuotDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // $this->call(ClientsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(QuotationsTableSeeder::class);
        $this->call(ProductQuotationTableSeeder::class);
        $this->call(RequireApprovalTotalsTableSeeder::class);
    }
}
