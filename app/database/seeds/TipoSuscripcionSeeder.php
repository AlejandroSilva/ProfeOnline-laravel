<?php

class TipoSuscripcionSeeder extends Seeder {

    public function run(){
        DB::table('tiposuscripcion')->insert([
            array(
                'descripcion'=>'Creador',
            ),
            array(
                'descripcion'=>'Suscriptor',
            ),
        ]);
    }
}
