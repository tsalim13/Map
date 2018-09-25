<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email',60)->nullable();
            $table->string('tel',15)->nullable();
            $table->string('adresse',100)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
