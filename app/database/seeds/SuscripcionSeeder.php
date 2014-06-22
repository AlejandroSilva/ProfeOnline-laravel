<?php

class SuscripcionSeeder extends Seeder {

    public function run(){
        // agregar unos elementos base
        DB::table('suscripcion')->insert(
            array(
                // Docentes "dueños"/"creadores" de asignaturas
                array(
                    'codigo_tipo_suscripcion' => '1',   // creador
                    'codigo_usuario' => '3',            // Docente 1
                    'codigo_asignatura' => '1'          // Economia
                ),
                array(
                    'codigo_tipo_suscripcion' => '1',   // creador
                    'codigo_usuario' => '3',            // Docente 1
                    'codigo_asignatura' => '4'          // Taller nivelacion
                ),
                array(
                    'codigo_tipo_suscripcion' => '1',   // creador
                    'codigo_usuario' => '4',            // Docente 2
                    'codigo_asignatura' => '3'          // Contabilidad General
                ),
                array(
                    'codigo_tipo_suscripcion' => '1',   // creador
                    'codigo_usuario' => '4',            // Docente 2
                    'codigo_asignatura' => '2'          // Administración de  Empresas
                ),
                // Alumnos suscritos
                array(
                    'codigo_tipo_suscripcion' => '2',   // suscrito
                    'codigo_usuario' => '6',            // Alumno 1
                    'codigo_asignatura' => '1'          // Economia
                ),
                array(
                    'codigo_tipo_suscripcion' => '2',   // suscrito
                    'codigo_usuario' => '6',            // Alumno 1
                    'codigo_asignatura' => '3'          // Contabilidad General
                ),
                array(
                    'codigo_tipo_suscripcion' => '2',   // suscrito
                    'codigo_usuario' => '7',            // Alumno 2
                    'codigo_asignatura' => '1'          // Economia
                )
            )
        );
    }
}
