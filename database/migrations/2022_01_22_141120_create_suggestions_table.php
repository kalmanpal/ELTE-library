<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreign('email')->references('email')->on('users');
            $table->integer('art_number')->default('0');
            $table->integer('classics_number')->default('0');
            $table->integer('comics_number')->default('0');
            $table->integer('food_number')->default('0');
            $table->integer('history_number')->default('0');
            $table->integer('financial_number')->default('0');
            $table->integer('kids_number')->default('0');
            $table->integer('lifestyle_number')->default('0');
            $table->integer('learning_number')->default('0');
            $table->integer('literature_number')->default('0');
            $table->integer('travel_number')->default('0');
            $table->integer('tech_number')->default('0');
            $table->integer('religion_number')->default('0');
            $table->integer('sports_number')->default('0');
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
        Schema::dropIfExists('suggestions');
    }
}
