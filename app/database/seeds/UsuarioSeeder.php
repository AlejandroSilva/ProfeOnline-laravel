<?php

class UsuarioSeeder extends Seeder {

    public function run(){
        // agregar unos elementos base
        DB::table('usuario')->insert(
            array(
                array(
                    'codigo_tipo_usuario' => '1',
                    'nombre' => 'DonAdministrador',
                    'email' => 'admin@a.a',
                    'password' => Hash::make('admin')
                ),
                array(
                    'codigo_tipo_usuario' => '2',
                    'nombre' => 'Docente 1',
                    'email' => 'docente1@a.a',
                    'password' => Hash::make('docente1')
                ),
                array(
                    'codigo_tipo_usuario' => '3',
                    'nombre' => 'Alumno 1',
                    'email' => 'alumno1@a.a',
                    'password' => Hash::make('alumno1')
                )
            )
        );
    }
}
