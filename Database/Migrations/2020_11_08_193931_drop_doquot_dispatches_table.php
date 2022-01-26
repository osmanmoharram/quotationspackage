<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDoquotDispatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('doquot_dispatches');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('doquot_dispatches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->date('request_date')->nullable();
            $table->enum('status', ['new', 'delivered', 'rejected', 'processed', 'received'])->default('new');
            $table->string('rejection_reason')->nullable();
            $table->timestamps();
        });
    }
}
