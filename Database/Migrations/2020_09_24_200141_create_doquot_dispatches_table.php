<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDOQuotDispatchesTable extends Migration
{
    public function up()
    {
        Schema::create('doquot_dispatches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('employ_id')->nullable();
            $table->date('request_date')->nullable();
            $table->enum('status', ['new', 'delivered', 'rejected', 'processed', 'received'])->default('new');
            $table->string('rejection_reason')->nullable();
            $table->timestamps();

            // $table->foreign('department_id')->references('id')->on('doquot_departments')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::dropIfExists('doquot_dispatches');
    }
}
