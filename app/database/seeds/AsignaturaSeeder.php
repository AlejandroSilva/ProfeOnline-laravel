<?php

class AsignaturaSeeder extends Seeder {

    public function run(){
        DB::table('asignatura')->insert([
            array(
                'codigo_carrera'=>'1',
                'nombre'=>'Economía',
                'anno'=>'2014',
            ),
            array(
                'codigo_carrera'=>'2',
                'nombre'=>'Administración de  Empresas',
                'anno'=>'2014',
            ),
            array(
                'codigo_carrera'=>'1',
                'nombre'=>'Contabilidad General',
                'anno'=>'2014',
            ),
            array(
                'codigo_carrera'=>'3',
                'nombre'=>'Taller de Nivelación',
                'anno'=>'2014',
            ),
        ]);
    }
}