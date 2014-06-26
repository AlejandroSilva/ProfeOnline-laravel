<?php

class PublicacionSeeder extends Seeder {

    public function run(){
        // la hora/fecha actual
        $timezone= new DateTimeZone("America/Santiago");
        $horaFechaActual = new \DateTime;
        $horaFechaActual->setTimezone($timezone);

        DB::table('publicacion')->insert([
            // asignatura 1: Economia
            array(
                'codigo_asignatura'=>'1',   // Economia
                'titulo'=>'Bienvenidos',
                'mensaje'=>'Beivenidos a la asignatura... laboriosam consequuntur obcaecati magnam veniam repellendus quaerat debitis dolores possimus quas deserunt illum ipsam. Porro!',
                'created_at' => $horaFechaActual,
                'updated_at' => $horaFechaActual
            ),
            array(
                'codigo_asignatura'=>'1',   // Econpomia
                'titulo'=>'Prueba 1',
                'mensaje'=>'El proimo martes hay prueba, estudien!!... possimus quas deserunt illum ipsam. Porro!',
                'created_at' => $horaFechaActual,
                'updated_at' => $horaFechaActual
            ),

            // asignatura 2: Administracion de empresas
            array(
                'codigo_asignatura'=>'2',   // Administracion de empresas
                'titulo'=>'Bienvenidos a la asignatura',
                'mensaje'=>'possimus quas deserunt illum ipsam. Porro!',
                'created_at' => $horaFechaActual,
                'updated_at' => $horaFechaActual
            ),
            array(
                'codigo_asignatura'=>'2',   // Administracion de empresas
                'titulo'=>'Vacaciones',
                'mensaje'=>'Las vacaciones comienzan el proximo lunes..',
                'created_at' => $horaFechaActual,
                'updated_at' => $horaFechaActual
            ),

            // asignatura 3: contabilidad general
            array(
                'codigo_asignatura'=>'3',   // contabilidad general
                'titulo'=>'publicacion 1',
                'mensaje'=>'Lorem ipsum voluptatibus facilis, laboriosam consequuntur obcaecati magnam veniam repellendus quaerat debitis dolores possimus quas deserunt illum ipsam. Porro!',
                'created_at' => $horaFechaActual,
                'updated_at' => $horaFechaActual
            ),
            array(
                'codigo_asignatura'=>'3',   // contabilidad general
                'titulo'=>'publicacion 2',
                'mensaje'=>'Lorem ipsum repellendus quaerat debitis dolores possimus quas deserunt illum ipsam. Porro!',
                'created_at' => $horaFechaActual,
                'updated_at' => $horaFechaActual
            ),
            array(
                'codigo_asignatura'=>'3',   // contabilidad general
                'titulo'=>'publicacion 3',
                'mensaje'=>'dolorem aliquam magni voluptatibus facilis, laboriosam consequuntur obcaecati magnam veniam repellendus quaerat debitis dolores possimus quas deserunt illum ipsam. Porro!',
                'created_at' => $horaFechaActual,
                'updated_at' => $horaFechaActual
            ),
            array(
                'codigo_asignatura'=>'3',   // contabilidad general
                'titulo'=>'publicacion 4',
                'mensaje'=>'Lorem ipsum elit. Dolore at dolorem aliquam magni voluptatibus facilis, laboriosam consequuntur obcaecati magnam veniam repellendus quaerat debitis dolores possimus quas deserunt illum ipsam. Porro!',
                'created_at' => $horaFechaActual,
                'updated_at' => $horaFechaActual
            ),

            // asignatura 4: Taller de nivelacion
            // (se deja sin publicaciones de forma momentanea)
        ]);
    }
}