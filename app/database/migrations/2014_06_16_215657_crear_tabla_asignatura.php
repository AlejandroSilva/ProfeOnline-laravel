<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAsignatura extends Migration {
	public function up(){
        Schema::create('asignatura', function($table){
            $table->increments('codigo_asignatura');   // primary key
            $table->integer('codigo_carrera')->length(10)->unsigned();
            $table->string('nombre', 45);
            $table->string('anno', 10);

            // foreign key
            // relacion con Carrera
            $table->foreign('codigo_carrera')->references('codigo_carrera')->on('carrera')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
	}

	public function down(){
		Schemma::drop('asignatura');
	}
}
