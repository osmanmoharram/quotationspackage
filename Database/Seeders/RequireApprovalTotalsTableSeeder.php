<?php

namespace DOCore\DOQuot\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequireApprovalTotalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doquot_require_approval_totals')->truncate();

        $totals = [
            1285964, 12856, 4256, 8569, 4571, 3625,
        ];
        foreach($totals as $total){
            DB::table('doquot_require_approval_totals')->insert([
                'value' => $total
            ]);
        }

        DB::table('doquot_require_approval_totals')
            ->where('value', 1285964)
            ->update(['applied' => true]);
    }
}
