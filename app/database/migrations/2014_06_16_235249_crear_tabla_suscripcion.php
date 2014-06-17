<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSuscripcion extends Migration {

    public function up(){
        Schema::create('suscripcion', function($table){
            $table->increments('codigo_suscripcion');   // primary key
            $table->integer('codigo_tipo_suscripcion')->length(10)->unsigned();
            $table->integer('codigo_usuario')->length(10)->unsigned();
            $table->integer('codigo_asignatura')->length(10)->unsigned();

            // foreign key
            // relacion con TipoSuscripcion
            $table->foreign('codigo_tipo_suscripcion')->references('codigo_tipo_suscripcion')->on('tiposuscripcion')->onDelete('CASCADE')->onUpdate('CASCADE');
            // relacion con Usuario
            $table->foreign('codigo_usuario')->references('codigo_usuario')->on('usuario')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('codigo_asignatura')->references('codigo_asignatura')->on('asignatura')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    public function down(){
        Schema::drop('suscripcion');
    }
}
