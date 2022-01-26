<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoquotDispatchProductTable extends Migration
{
    public function up()
    {
        Schema::create('doquot_dispatch_product', function (Blueprint $table) {
            $table->unsignedInteger('dispatch_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();

            $table->primary(['dispatch_id', 'product_id']);

            /*$table->foreign('dispatch_id')->references('id')->on('doquot_dispatches')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('doquot_products')->onUpdate('CASCADE')->onDelete('CASCADE');*/
        });
    }

    public function down()
    {
        Schema::dropIfExists('doquot_dispatch_product');
    }
}
