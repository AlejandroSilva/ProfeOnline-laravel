<?php

class DocenteController extends \BaseController {

    public function inicio(){
        return View::make('docente.inicio');
        //return Redirect::to('docente/misAsignaturas');
    }

    public function misAsignaturas(){
        // obtenemos el listado de todas las suscipciones que administra
        $asignaturas = Auth::user()->asignaturasCreadas();

        // se las entregamos a la vista para que las muestre
        return View::make('docente.misasignaturas')->with('asignaturas', $asignaturas);
    }

    /*
 * Se hacen las validaciones para los siguientes metodos:
 * - el usuario esta logeado? (filtro "logeadoComoDocente")
 * - el usuario es docente? (filtro "logeadoComoDocente")
 * - El usuario es dueño de la publicacion/asignatura? (filtro "duenoDeLaAsignatura")
*/
    public function destacarPublicacion($codigo_asignatura){
        $codigo_publicacion = Input::get('codigo_publicacion');

        // obtener la publicacion deseada
        $publicacion = Publicacion::find($codigo_publicacion);
        if($publicacion==null){
            return Response::json( array('message'=>'no existe la publicacion que desea calificar'),400);  // bad request
        }

        // obtener la asignatura a la que pertenece la publicacion
        $asignatura = $publicacion->asignatura;

        // cualquier publicacion destacada anterior, ahora no lo es
        foreach( $asignatura->publicacionesDestacadas as $destacada ){
            $destacada->destacada = 0;
            $destacada->save();
        }

        // si la seleccionada es destacada, dejarla como normal
        if( $publicacion->destacada==1 ){
            return Response::json( array('message'=>'la publicacion ya no es destacada'), 200);  // bad request
        }else{
            // la publicacion seleccionada, es la nueva destacada
            $publicacion->destacada = 1;
            $publicacion->save();

            return Response::json( array('message'=>'la publicacion ha sido destacada') );
        }
    }

    public function nuevaPublicacion($codigo_asignatura){
        $asignatura = Asignatura::find($codigo_asignatura);

        // si la asignatura no existe, mostrar una vista con el error
        if($asignatura==null)
            return Redirect::to('asignatura404');

        return View::make('asignatura.administrar.base')->with('asignatura', $asignatura)
            ->nest('sub_vista', 'asignatura.administrar.nuevaPublicacion');
    }
}
