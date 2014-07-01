<?php

class GenericController extends \BaseController {

    public function inicio(){
        // si no esta logeado, mostrar la pagina HOME
        if( Auth::guest() )
            return View::make('home');
        elseif( Auth::user()->esAdministrador() )
            return Redirect::to('administracion/inicio');
        elseif( Auth::user()->esDocente() )
            return Redirect::to('docente/inicio');
        elseif( Auth::user()->esAlumno() )
            return View::make('alumno/inicio');
        else{
            return "no existe una pagina de inicio para tu tipo de usuario, contacta al administrador";
        }
    }

    // muestra todas las asignaturas existentes en el sistema
    public function mostrarTodas(){
        // obtener todas las asignaturas
        $asignatura = Asignatura::all();
        // mostrar las asignaturas
        return View::make('alumno.buscar')->with("asignaturas", $asignatura);
    }

    // muestra las asignaturas que contienen dentro de su nombre el texto ingresado en el formulario
    public function post_buscarPorNombre(){
        // el nombre buscado por el formulario
        $nombre = Input::get('nombre');
        // hacer la consulta para obtener las asignaturas
        $asignaturas = Asignatura::where('nombre', 'LIKE', '%'.$nombre.'%')->get();
        // mostrar las asignaturas
        return View::make('alumno.buscar')->with("asignaturas", $asignaturas);
    }

    // muestra las asignaturas que son creadas por el nombre del docente que se ingreso en el formulario
    public function post_buscarPorDocente(){
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

    // pagina publica para mostrar una asignatura que no existe en el sistema
    public  function asignaturaNoEncontrada(){
        return View::make('asignatura.noEncontrada');
    }
}