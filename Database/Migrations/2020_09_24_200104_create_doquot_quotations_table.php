<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDOQuotQuotationsTable extends Migration
{
    public function up()
    {
        Schema::create('doquot_quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('department_id')->nullable();
            $table->date('request_date')->nullable();
            $table->string('require_admin_approval')->nullable()->default('no');
            $table->enum('status', ['new', 'approved', 'rejected'])->default('new');
            $table->text('rejection_reason')->nullable();
            $table->unsignedDecimal('tax')->nullable();
            $table->unsignedInteger('validity')->default(3); // in days
            $table->timestamps();

            /*$table->foreign('client_id')->references('client_id')->on('clients')->onUpdate('CASCADE')->onDelete('CASCADE');*/
            /*$table->foreign('department_id')->references('id')->on('doquot_departments')->onUpdate('CASCADE')->onDelete('SET NULL');*/
        });
    }

    public function down()
    {
        Schema::dropIfExists('doquot_quotations');
    }
}
