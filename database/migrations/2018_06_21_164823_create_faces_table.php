<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_emplacement')->unsigned()->nullable();
            $table->integer('id_support')->unsigned()->nullable();
            $table->string('code', 15)->unique();
            $table->boolean('etat');
            $table->foreign('id_emplacement')->references('id')->on('markers')
                        ->onDelete('SET NULL')
                        ->onUpdate('cascade');
            $table->foreign('id_support')->references('id')->on('supports')
                        ->onDelete('SET NULL')
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
        Schema::dropIfExists('faces');
    }
}
