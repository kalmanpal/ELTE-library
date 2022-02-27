<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreign('email')->references('email')->on('users');
            $table->boolean('5rentals')->default('0');
            $table->boolean('10rentals')->default('0');
            $table->boolean('20rentals')->default('0');
            $table->boolean('3inarow')->default('0');
            $table->boolean('ontime')->default('0');
            $table->boolean('friend')->default('0');
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
        Schema::dropIfExists('badges');
    }
}
