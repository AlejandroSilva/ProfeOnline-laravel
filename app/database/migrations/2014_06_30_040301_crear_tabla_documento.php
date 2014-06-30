<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDocumento extends Migration {

	public function up(){
        Schema::create('documento', function($table){
            $table->increments('codigo_documento');   // primary key
            $table->integer('codigo_publicacion')->length(10)->unsigned();
            $table->string('nombre');
            $table->string('url');

            // foreign key
            // relacion con Publicacion
            $table->foreign('codigo_publicacion')->references('codigo_publicacion')->on('publicacion')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
	}


	public function down(){
		Schema::drop('documento');
	}

}


