<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_face')->unsigned();
            $table->integer('id_horaire')->unsigned();
            $table->integer('minuterie', 15);
            $table->integer('heure_de_pointe', 15);
            $table->integer('nbr_deffilement', 15);
            $table->foreign('id_face')->references('id')->on('faces')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreign('id_horaire')->references('id')->on('horaires')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarifs');
    }
}
