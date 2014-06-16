<?php

class CarreraSeeder extends Seeder {

    public function run(){
        DB::table('carrera')->insert([
            array(
                'codigo_sede'=>'1',
                'nombre'=>'Contador Auditor',
                'titulo'=>'Contador Auditor',
                'jornada'=>'Vespertina'
            ),
            array(
                'codigo_sede'=>'1',
                'nombre'=>'Tecnico en Administración',
                'titulo'=>'Técnico de Nivel Superior en Administración',
                'jornada'=>'Diurna'
            ),
            array(
                'codigo_sede'=>'3',
                'nombre'=>'Ingeniería Comercial',
                'titulo'=>'Ingeniero Comercial',
                'jornada'=>'Diurna'
            ),
            array(
                'codigo_sede'=>'5',
                'nombre'=>'Contabilidad General',
                'titulo'=>'Contador General de Nivel Superior',
                'jornada'=>'Vespertina'
            )
        ]);
    }
}