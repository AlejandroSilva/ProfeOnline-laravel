<?php

class UsuarioSeeder extends Seeder {

    public function run(){
        // agregar unos elementos base
        DB::table('usuario')->insert(
            array(
                // Administradores
                array(
                    'codigo_tipo_usuario' => '1',
                    'nombre' => 'DonAdministrador',
                    'email' => 'admin@a.a',
                    'password' => Hash::make('admin')
                ),
                array(
                    'codigo_tipo_usuario' => '1',
                    'nombre' => 'Segundo Administrador',
                    'email' => 'admin2@a.a',
                    'password' => Hash::make('admin2')
                ),
                // Docentes
                array(
                    'codigo_tipo_usuario' => '2',
                    'nombre' => 'Don Andres Andaur',
                    'email' => 'docente1@a.a',
                    'password' => Hash::make('docente1')
                ),
                array(
                    'codigo_tipo_usuario' => '2',
                    'nombre' => 'Sra. Beatriz Baez',
                    'email' => 'docente2@a.a',
                    'password' => Hash::make('docente2')
                ),
                array(
                    'codigo_tipo_usuario' => '2',
                    'nombre' => 'Carlos Campos',
                    'email' => 'docente3@a.a',
                    'password' => Hash::make('docente3')
                ),
                // Alumnos
                array(
                    'codigo_tipo_usuario' => '3',
                    'nombre' => 'Andres Aguilera',
                    'email' => 'alumno1@a.a',
                    'password' => Hash::make('alumno1')
                ),
                array(
                    'codigo_tipo_usuario' => '3',
                    'nombre' => 'Boris Benitez',
                    'email' => 'alumno2@a.a',
                    'password' => Hash::make('alumno2')
                ),
                array(
                    'codigo_tipo_usuario' => '3',
                    'nombre' => 'Carla Cacerez',
                    'email' => 'alumno3@a.a',
                    'password' => Hash::make('alumno3')
                )
            )
        );
    }
}
