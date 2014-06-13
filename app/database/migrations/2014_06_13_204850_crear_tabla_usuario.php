<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
        Schema::create('usuario', function(Blueprint $table){
            $table->increments('codigo_usuario');   // primary key
            // todas las FK deben ser UNSIGNED INTEGER de largo 10
            $table->integer('codigo_tipo_usuario')->length(10)->unsigned();
            $table->string('nombre', 45);
            $table->string('email', 45)->unique();
            $table->string('password', 60);
            // para "recordar" a los usuarios logeados, lo necesita laravel
            $table->string('remember_token', 100)->nullable();

            // relacion con TipoUsuario
            $table->foreign('codigo_tipo_usuario')->references('codigo_tipo_usuario')->on('tipousuario')->onDelete('CASCADE')->onUpdate('CASCADE');   // foreign key
        });
	}

	public function down(){
        Schema::drop('usuario');
	}

}
