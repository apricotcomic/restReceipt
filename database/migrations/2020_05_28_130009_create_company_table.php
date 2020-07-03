<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable($value = true);
            $table->string('zip')->nullable($value = true);
            $table->string('tel')->nullable($value = true);
            $table->string('fax')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->string('stamp_image')->nullable($value = true);
            $table->string('receipt_image')->nullable($value = true);
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
        Schema::dropIfExists('company');
    }
}
