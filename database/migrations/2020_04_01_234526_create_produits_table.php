<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->float('prix');
            $table->integer('remise');
            $table->Date('datDebut');
            $table->dateTime('datFin');
            $table->timestamps();
            $table->integer('catId')->unsigned();
            $table->foreign('catId')->references('id')->on('catproduits');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
