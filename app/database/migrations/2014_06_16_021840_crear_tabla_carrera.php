<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCarrera extends Migration {

    public function up(){
        Schema::create('carrera', function(Blueprint $table){
            $table->increments('codigo_carrera');   // primary key
            $table->integer('codigo_sede')->length(10)->unsigned();
            $table->string('nombre', 45);
            $table->string('titulo', 45);
            $table->string('jornada', 12);

            // foreign key
            // relacion con TipoUsuario
            $table->foreign('codigo_sede')->references('codigo_sede')->on('sede')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    public function down(){
        Schema::drop('carrera');
    }

}