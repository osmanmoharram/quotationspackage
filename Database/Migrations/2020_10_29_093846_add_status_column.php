<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumn extends Migration
{
    public function up()
    {
        Schema::table('doquot_dispatches', function (Blueprint $table) {
            $table->string('status')->default('new');
        });
    }

    public function down()
    {
        Schema::table('doquot_dispatches', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
