<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTipousuario extends Migration {


	public function up(){
        Schema::create('tipousuario', function(Blueprint $table){
            $table->increments('codigo_tipo_usuario');   // primary key
            $table->string('descripcion', 20)->unique();
        });
	}

	public function down(){
        Schema::drop('tipousuario');
	}

}
