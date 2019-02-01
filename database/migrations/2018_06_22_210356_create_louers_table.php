<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLouersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('louers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('face_id')->unsigned()->nullable();
            $table->date('fromDate');
            $table->date('toDate');
            $table->boolean('etat')->default(0);
            $table->foreign('client_id')->references('id')->on('clients')
                        ->onDelete('SET NULL')
                        ->onUpdate('cascade');
            $table->foreign('face_id')->references('id')->on('faces')
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
        Schema::table('louers', function(Blueprint $table) {
        $table->dropForeign('louers_client_id_foreign');
        $table->dropForeign('louers_marker_id_foreign');
        });

        Schema::drop('louers');

    }
}
