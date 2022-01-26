<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalColumn extends Migration
{
    public function up()
    {
        Schema::table('doquot_quotations', function (Blueprint $table) {
            $table->unsignedDecimal('total')->default(0);
        });
    }

    public function down()
    {
        Schema::table('doquot_quotations', function (Blueprint $table) {
            $table->dropColumn('total');
        });
    }
}
