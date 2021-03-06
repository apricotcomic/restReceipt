<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt', function (Blueprint $table) {
            $table->id();
            $table->dateTime('purchase_date');
            $table->bigInteger('company_id');
            $table->string('branch_id');
            $table->string('terminal_id');
            $table->string('original_receipt_id');
            $table->bigInteger('total_tax');
            $table->bigInteger('total_fee');
            $table->bigInteger('original_JSON_id');
            $table->dateTime('certify_date')->nullable();
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
        Schema::dropIfExists('receipt');
    }
}
