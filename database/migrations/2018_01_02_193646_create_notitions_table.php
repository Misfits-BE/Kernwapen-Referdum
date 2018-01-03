<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned(); 
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id') ->references('id')->on('cities') ->onDelete('cascade');

            $table->boolean('status')->default(false);
            $table->string('titel'); 
            $table->text('beschrijving');
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
        Schema::dropIfExists('notitions');
    }
}
