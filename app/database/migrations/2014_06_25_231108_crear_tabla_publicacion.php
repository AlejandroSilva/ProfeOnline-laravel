<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPublicacion extends Migration {

    public function up(){
        Schema::create('publicacion', function($table){
            $table->increments('codigo_publicacion');   // primary key
            $table->integer('codigo_asignatura')->length(10)->unsigned();
            $table->string('titulo', 45);
            $table->string('mensaje');
            $table->timestamps();   // fecha/hora de creacion y modificacion

            // foreign key
            // relacion con Asignatura
            $table->foreign('codigo_asignatura')->references('codigo_asignatura')->on('asignatura')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    public function down(){
        Schema::drop('publicacion');
    }
}
