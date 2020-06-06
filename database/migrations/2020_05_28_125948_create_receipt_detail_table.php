<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('receipt_id');
            $table->integer('line_no');
            $table->string('item_name');
            $table->integer('unit_price');
            $table->integer('quantity');
            $table->bigInteger('tax');
            $table->bigInteger('fee');
            $table->string('item_1');
            $table->string('item_2');
            $table->string('item_3');
            $table->string('item_4');
            $table->string('item_5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_detail');
    }
}
