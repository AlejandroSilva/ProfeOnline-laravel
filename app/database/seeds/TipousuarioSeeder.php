<?php

class TipousuarioSeeder extends Seeder {

    public function run(){
        // agregar unos elementos base
        DB::table('tipousuario')->insert(
            array(
                'descripcion' => 'Administrador'
            )
        );
        DB::table('tipousuario')->insert(
            array(
                'descripcion' => 'Docente'
            )
        );
        DB::table('tipousuario')->insert(
            array(
                'descripcion' => 'Alumno'
            )
        );
    }
}
