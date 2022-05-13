<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oldsubs', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreign('email')->references('email')->on('users');
            $table->date('from');
            $table->date('to');
            $table->integer('discount')->default('0');
            $table->integer('plusfee')->default('0');
            $table->integer('paidfee');
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
        Schema::dropIfExists('oldsubs');
    }
}
