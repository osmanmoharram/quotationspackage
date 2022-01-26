<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doquot_quotations', function (Blueprint $table) {
            $table->dropColumn('department_id');
            $table->dropColumn('request_date');
            $table->dropColumn('require_admin_approval');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doquot_quotations', function (Blueprint $table) {
            $table->unsignedInteger('department_id')->nullable();
            $table->date('request_date')->nullable();
            $table->string('require_admin_approval')->nullable()->default('no');
        });
    }
}
