<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEstadopublicacion extends Migration {

    public function up(){
        Schema::create('estadopublicacion', function ($table) {
            // Primary key compuesta
            $table->integer('codigo_suscripcion')->length(10)->unsigned();
            $table->integer('codigo_publicacion')->length(10)->unsigned();
            $table->primary(array('codigo_publicacion', 'codigo_suscripcion'));
            // campos de la tabla
            $table->boolean('leido')->default(true);;   // default 1

            // foreign key: relacion con Publicacion
            $table->foreign('codigo_publicacion')->references('codigo_publicacion')->on('publicacion')->onDelete('CASCADE')->onUpdate('CASCADE');
            // foreign key: relacion con Suscripcion
            $table->foreign('codigo_suscripcion')->references('codigo_suscripcion')->on('suscripcion')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    public function down(){
        Schema::drop('estadopublicacion');
    }

}
