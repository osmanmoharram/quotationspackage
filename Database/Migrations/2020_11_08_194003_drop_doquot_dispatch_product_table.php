<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDoquotDispatchProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('doquot_dispatch_product');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('doquot_dispatch_product', function (Blueprint $table) {
            $table->unsignedInteger('dispatch_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();

            $table->primary(['dispatch_id', 'product_id']);
        });
    }
}
