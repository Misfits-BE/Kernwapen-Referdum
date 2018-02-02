<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->unsigned();
            $table->integer('postal');
            $table->string('name', 100);
            $table->string('lat', 50);
            $table->string('lng', 50);
            $table->boolean('kernwapen_vrij')->default(0);
            $table->timestamps();

            // Foreign keys 
            $table->foreign('province_id')->references('id')->on('provinces');
        });

        Schema::create('city_signature', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned(); 
            $table->integer('signature_id')->unsigned();
            $table->timestamps(); 

            // Foreign keys
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('signature_id')->references('id')->on('signatures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cities');
        Schema::dropIfExists('city_signature');
        Schema::enableForeignKeyConstraints();
    }
}
