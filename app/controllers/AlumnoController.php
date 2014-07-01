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
        $asignatura = Asignatura::find($codigo_asignatura);

        // si la asignatura no existe, mostrar una vista con el error
        if($asignatura==null)
            return Redirect::to('asignatura404');

        // definir el tipo de vista para la Asignatura segun el usuario que la visita
        if( Auth::check() ){
            // Si el usuario logeado es el Docente que creo la asignatura, entonces puede Configurar, Enviar documentos, etc.
            if( Auth::user()->codigo_usuario == $asignatura->getDocente()->codigo_usuario ){
                // mostrar la vista para el Docente Creador (para administrar)
                return View::make('asignatura.administrar.base')->with('asignatura', $asignatura)
                    ->nest('sub_vista', 'asignatura.sub-vistas.publicaciones.vistaDocenteDueno', array('asignatura'=>$asignatura) );    // opciones del Docente creador

            }else{
                // mostrar la vista para un usuario normal (suscribir, dar de baja)
                return View::make('asignatura.base')->with('asignatura', $asignatura)
                    ->nest('sub_vista', 'asignatura.sub-vistas.publicaciones.vistaUsuarios', array('asignatura'=>$asignatura) );  // opciones de usuario registrado
            }
        }else{
            // mostrar la vista publica de la pagina, sin mayores opciones
            return View::make('asignatura.base')->with('asignatura', $asignatura)
                ->nest('sub_vista', 'asignatura.sub-vistas.publicaciones.vistaInvitados', array('asignatura'=>$asignatura) );    // vista publica sin opciones
        }
    }

    public function post_suscribir($codigo_asignatura){
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

    public function post_dardebaja($codigo_asignatura){
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

}