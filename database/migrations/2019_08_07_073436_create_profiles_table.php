<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
          $table->unsignedInteger('user_id')->default(1);
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->text('state')->nullable();
            $table->string('city')->nullable();
            $table->UnsignedInteger('phone')->nullable();
           $table->string('thumbnail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
