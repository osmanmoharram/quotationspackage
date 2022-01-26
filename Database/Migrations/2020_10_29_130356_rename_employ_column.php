<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEmployColumn extends Migration
{
    public function up()
    {
        Schema::table('doquot_dispatches', function (Blueprint $table) {
            $table->renameColumn('employ_id', 'employee_id');
        });
    }

    public function down()
    {
        Schema::table('doquot_dispatches', function (Blueprint $table) {
            $table->renameColumn('employee_id', 'employ_id');
        });
    }
}
