<?php

class AlumnoController extends \BaseController {

    public function suscritas(){
        // obtenemos el listado de las asignaturas suscritas
        $asignaturas = Auth::user()->asignaturasSuscritas();
        // se las entregamos a la vista para que las muestre
        return View::make('alumno.suscritas')->with("asignaturas", $asignaturas);
    }

    // pagina publica para mostrar una asignatura que no existe en el sistema
    public  function asignaturanoexiste(){
        return View::make('asignatura.noEncontrada');
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
}