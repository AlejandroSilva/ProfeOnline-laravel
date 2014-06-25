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

            // agregar al array la asignatura suscrita
            array_push($asignaturas, $asignatura);
        }
        return View::make('alumno.suscritas')->with("asignaturas", $asignaturas);
    }

    public function ver_asignatura($codigo_asignatura){
        // obtenemos la asignatura de interes
        $asig = Asignatura::find($codigo_asignatura);

        // si la asignatura no existe, mostrar una vista con el error
        if($asig==null)
            return View::make('asignaturaNoEncontrada');

        // si existe, mostrar si informacion
        else
            return View::make('asignatura')->with('asignatura', $asig);
    }

    public function suscribir($codigo_asignatura){
        $codigo_usuario =  Auth::user()->codigo_usuario;

        // validar que la asignatura exista
        $asignatura = Asignatura::find($codigo_asignatura);
        if( $asignatura==null ){
            return Redirect::back()->withErrors( array('error' => 'la asignatura no existe') );
        }

        // validar que la suscripcion no exista previamente
        $suscripcion = Suscripcion::
            where('codigo_usuario', '=', $codigo_usuario)
            ->where('codigo_asignatura', '=', $codigo_asignatura)
            ->first();
        if( $suscripcion!=null ){
            return Redirect::back()->withErrors( array('error' => 'este usuario ya esta suscrito a la asignatura') );
        }

        // crear la suscripcion y guardarla en la BD
        $nuevaSuscripcion = new Suscripcion;
        $nuevaSuscripcion->codigo_usuario = $codigo_usuario;
        $nuevaSuscripcion->codigo_asignatura = $codigo_asignatura;
        $nuevaSuscripcion->codigo_tipo_suscripcion = 2; // tipo "Suscriptor"
        $nuevaSuscripcion->save();

        // retornar a la pagina y actualizar los datos
        return Redirect::back();
    }

    public function dardebaja($codigo_asignatura){
        $codigo_usuario =  Auth::user()->codigo_usuario;

        // validar que la asignatura exista
        $asignatura = Asignatura::find($codigo_asignatura);
        if( $asignatura==null ){
            return Redirect::back()->withErrors( array('error' => 'la asignatura no existe') );
        }

        // validar que realmente se encuentre suscrito
        $suscripcion = Suscripcion::
            where('codigo_usuario', '=', $codigo_usuario)
            ->where('codigo_asignatura', '=', $codigo_asignatura)
            ->first();
        if( $suscripcion==null ){
            return Redirect::back()->withErrors( array('error' => 'usted no se encuentra suscrito a esta asignatura') );
        }

        // validar que no sea su creador, los dueños de una asignatura no pueden darse de baja
        if( $asignatura->getDocente()->codigo_usuario == $codigo_usuario ){
            return Redirect::back()->withErrors( array('error' => 'eres el docente que creo la asignatura, no te puedes dar de baja.') );
        }

        // eliminar la suscripcion de la BD
        $suscripcion->delete();

        // volver a la pagina anterior con los nuevos cambios
        return Redirect::back();
    }

    public function buscarTodas(){
        // obtener todas las asignaturas
        $asignatura = Asignatura::all();
        // mostrarlas
        return View::make('alumno.buscar')->with("asignaturas", $asignatura);
    }
}
