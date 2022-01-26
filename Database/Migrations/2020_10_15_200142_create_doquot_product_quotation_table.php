<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoquotProductQuotationTable extends Migration
{
    public function up()
    {
        Schema::create('doquot_product_quotation', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quotation_id');
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedDecimal('unit_price')->default(0);
            $table->timestamps();

            $table->primary(['product_id', 'quotation_id']);

            /*$table->foreign('product_id')->references('id')->on('doquot_products')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('quotation_id')->references('id')->on('doquot_quotations')->onUpdate('CASCADE')->onDelete('CASCADE');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doquot_product_quotation');
    }
}
