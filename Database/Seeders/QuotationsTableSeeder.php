<?php

namespace DOCore\DOQuot\Database\Seeders;

use DOCore\DOQuot\Models\Quotation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class QuotationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('doquot_quotations')->truncate();

        $quotations = [
            ['client_id' => 1, 'status' => 'new', 'rejection_reason' => '', 'tax' => '3', 'validity' => '3'],
            ['client_id' => 2, 'status' => 'approved', 'rejection_reason' => '', 'tax' => '4.2', 'validity' => '10'],
            ['client_id' => 3, 'status' => 'rejected', 'rejection_reason' => 'expired', 'tax' => '1.2', 'validity' => '3'],
            ['client_id' => 4, 'status' => 'new', 'rejection_reason' => '', 'tax' => '4.00', 'validity' => '2'],
            ['client_id' => 5, 'status' => 'approved', 'rejection_reason' => '', 'tax' => '1', 'validity' => '5'],
        ];

        foreach($quotations as $quotation){
            Quotation::create($quotation);
        }
    }
}
