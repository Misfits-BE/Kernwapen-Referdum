<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voornaam', 50);
            $table->string('achternaam', 50);
            $table->date('geboortedatum');
            $table->string('postcode', 4);
            $table->string('straatnaam', 125);
            $table->string('stadsnaam', 100);
            $table->string('huis_nr', 7);
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
        Schema::dropIfExists('signatures');
    }
}
