<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSede extends Migration {

	public function up(){
        Schema::create('sede', function(Blueprint $table){
            $table->increments('codigo_sede');   // primary key
            $table->string('nombre', 40)->unique();;
            $table->string('ciudad', 20);
            $table->string('direccion', 45)->nullable();
            $table->string('telefono', 15)->nullable();
        });
	}

	public function down(){
        Schema::drop('sede');
	}

}
