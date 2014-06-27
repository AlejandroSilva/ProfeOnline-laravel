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
            return View::make('asignatura.noEncontrada');

        // definir el tipo de vista para la Asignatura segun el usuario que la visita
        if( Auth::check() ){
            // Si el usuario logeado es el Docente que creo la asignatura, entonces puede Configurar, Enviar documentos, etc.
            if( Auth::user()->codigo_usuario == $asignatura->getDocente()->codigo_usuario ){
                // mostrar la vista para el Docente Creador (para administrar)
                return View::make('asignatura.paraDocenteCreador')->with('asignatura', $asignatura);
            }else{
                // mostrar la vista para un usuario normal
                return View::make('asignatura.paraUsuarios')->with('asignatura', $asignatura);
            }
        }else{
            // mostrar la vista publica de la pagina, sin mayores opciones
            return View::make('asignatura.paraPublico')->with('asignatura', $asignatura);
        }
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

    // muestra todas las asignaturas existentes en el sistema
    public function buscarTodas(){
        // obtener todas las asignaturas
        $asignatura = Asignatura::all();
        // mostrar las asignaturas
        return View::make('alumno.buscar')->with("asignaturas", $asignatura);
    }

    // muestra las asignaturas que contienen dentro de su nombre el texto ingresado en el formulario
    public function buscarPorNombre(){
        // el nombre buscado por el formulario
        $nombre = Input::get('nombre');
        // hacer la consulta para obtener las asignaturas
        $asignaturas = Asignatura::where('nombre', 'LIKE', '%'.$nombre.'%')->get();
        // mostrar las asignaturas
        return View::make('alumno.buscar')->with("asignaturas", $asignaturas);
    }

    // muestra las asignaturas que son creadas por el nombre del docente que se ingreso en el formulario
    public function buscarPorDocente(){
        // el nombre buscado por el formulario
        $nombreDocente = Input::get('nombreDocente');

        // obtener el listado de usuarios/docentes que tengan el strign en sus nombres
        $docentes = User::where('nombre', 'LIKE', '%'.$nombreDocente.'%')->get();

        // obtener todas las asignaturas de los usuarios/docentes que se encontraron
        $asignaturas = array();
        foreach($docentes as $docente){
            // obtener las asignaturas
            $asignaturas = array_merge( $asignaturas, $docente->asignaturasCreadas() );
        }

        // mostrar las asignaturas
        return View::make('alumno.buscar')->with("asignaturas", $asignaturas);
    }
    /*
    esta logeado? (filtro)
    es docente? (filtro)
    es dueño de la asignatura?
    */
    public function destacarPublicacion(){
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
}