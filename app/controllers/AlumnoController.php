<?php

class AlumnoController extends \BaseController {

    public function suscritas(){
        // obtenemos el codigo_de_usuario del usuario logeado
        $codigo_usuario = Auth::user()->codigo_usuario;
        // obtenemos el listado de todas las suscipciones que tiene
        $suscripciones = Suscripcion::where('codigo_usuario', '=', $codigo_usuario)->get();

        // el listado de asignaturas, listo para ser entregado a la vista
        $asignaturas = array();
        foreach( $suscripciones as $sus ){
            // asignatura de la suscripcion
            $asignatura = $sus->asignatura;

            // obtener el Usuario que creo la asignatura
            $suscripDocente = $asignatura->suscripcionDocente;
            $docente = User::find( $suscripDocente->codigo_usuario );

            // a la asignatura, asignarle el docente
            $asignatura->docente = $docente;

            array_push($asignaturas, $asignatura);
        }
        return View::make('alumno.suscritas')->with("asignaturas", $asignaturas);
    }
}
