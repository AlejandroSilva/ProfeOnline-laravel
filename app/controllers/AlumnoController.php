<?php

class AlumnoController extends \BaseController {

    public function suscritas(){
        // obtenemos el listado de las asignaturas suscritas
        $asignaturas = Auth::user()->asignaturasSuscritas();
        // se las entregamos a la vista para que las muestre
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
        if( Auth::user()->estaSuscritoA($codigo_asignatura) ){
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
        // mostrar las asignaturas
        return View::make('alumno.buscar')->with("asignaturas", $asignatura);
    }

    public function buscarPorNombre(){
        // el nombre buscado por el formulario
        $nombre = Input::get('nombre');
        // hacer la consulta para obtener las asignaturas
        $asignaturas = Asignatura::where('nombre', 'LIKE', '%'.$nombre.'%')->get();
        // mostrar las asignaturas
        return View::make('alumno.buscar')->with("asignaturas", $asignaturas);
    }


    // funcion pendiente hasta que se pueda obtener el listado de asignaturas de un docente
    public function buscarPorDocente(){
        // el nombre buscado por el formulario
        $nombreDocente = Input::get('nombreDocente');
        // obtener el usuario con el nombre (el primer match)
        $docente = User::where('nombre', 'LIKE', '%'.$nombreDocente.'%')->first();
        // obtener las asignaturas que estan a su nombre
        // (...)

        // hacer la consulta para obtener las asignaturas
        $asignaturas = Asignatura::where('nombre', 'LIKE', '%'.$nombre.'%')->get();
        // mostrar las asignaturas
        return View::make('alumno.buscar')->with("asignaturas", $asignaturas);
    }
}
