<?php

class SedeSeeder extends Seeder {

    public function run(){
        // agregar unos elementos base
        DB::table('sede')->insert([
            array(
                'nombre' => 'UST Santiago',
                'ciudad' => 'Santiago',
                'direccion' => 'Alameda #123',
                'telefono' => '65166'
            ),
            array(
                'nombre' => 'CFT Puente Alto',
                'ciudad' => 'Santiago',
                'direccion' => 'San Martin #123',
                'telefono' => '2'
            ),
            array(
                'nombre' => 'UST Talca',
                'ciudad' => 'Talca',
                'direccion' => 'San Martin #123',
                'telefono' => '213'
            ),
            array(
                'nombre' => 'IP/CFT San Joaquin',
                'ciudad' => 'Santiago',
                'direccion' => 'Maturana # 213',
                'telefono' => '123144'
            ),
            array(
                'nombre' => 'Los Angeles',
                'ciudad' => 'Los Angeles',
                'direccion' => 'Lautaro #2134',
                'telefono' => '22654456'
            ),
            array(
                'nombre' => 'IP Santo Tomas Curico',
                'ciudad' => 'Curico',
                'direccion' => 'Manso de Velasco 2213',
                'telefono' => '6549'
            )
        ]);
    }
}