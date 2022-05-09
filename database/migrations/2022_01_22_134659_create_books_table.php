<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->char('isbn' , 13)->unique();
            $table->string('title');
            $table->string('writer');
            $table->string('publisher');
            $table->string('release');
            $table->string('edition');
            $table->string('category');
            $table->integer('sum')->default('0');
            $table->integer('numberofratings')->default('0');
            $table->text('description');
            $table->string('picture');
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
        Schema::dropIfExists('books');
    }
}
