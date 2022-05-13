<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreign('email')->references('email')->on('users');
            $table->integer('all_months')->default('0');
            $table->boolean('active')->default('0');
            $table->date('subexpiry')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discounts')->default('0');
            $table->integer('plus_charge')->default('0');
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
        Schema::dropIfExists('subscriptions');
    }
}
