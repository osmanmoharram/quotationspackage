<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropStatusColumn extends Migration
{
    public function up()
    {
        Schema::table('doquot_dispatches', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

    public function down()
    {
        Schema::table('doquot_dispatches', function (Blueprint $table) {
            $table->enum('status', ['new', 'approved', 'rejected'])->default('new');
        });
    }
}
