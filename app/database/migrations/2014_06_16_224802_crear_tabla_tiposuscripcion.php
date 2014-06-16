<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTiposuscripcion extends Migration {

    public function up(){
        Schema::create('tiposuscripcion', function($table){
            $table->increments('codigo_tipo_suscripcion');   // primary key
            $table->string('descripcion', 20);
        });
    }

	public function down(){
        Schema::drop('tiposuscripcion');
	}
}
