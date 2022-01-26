<?php

use DOCore\DOQuot\Models\Quotation;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Quotation::class, function (Faker $faker) {
    return [
        'client_id' => $this->faker->randomElement(DB::table('clients')->select('id')->get()->toArray()),
        'department_id' => $this->faker->randomElement(DB::table('doquot_departments')->select('id')->get()->toArray()),
        'request_date' => Carbon::now(),
        'require_admin_approval' => $this->faker->randomElement('true', 'flase'),
        'status' => 'new',
    ];
});
