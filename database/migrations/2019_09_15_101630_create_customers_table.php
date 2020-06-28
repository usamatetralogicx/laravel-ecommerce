<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('billing_firstName');
            $table->string('billing_lastName');
            $table->string('email');
            $table->string('username');
            $table->text('billing_address_1');
            $table->text('billing_address_2')->nullable();
            $table->string('billing_country');
            $table->string('billing_state');
            $table->UnsignedInteger('billing_zip');
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
        Schema::dropIfExists('customers');
    }
}
