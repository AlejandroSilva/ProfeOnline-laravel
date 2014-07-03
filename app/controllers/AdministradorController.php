<?php

class AdministradorController extends \BaseController {

    public function inicio(){
        return View::make('administrador.inicio');
    }

    public function sedes(){
        return View::make('administrador.sedes');
    }

    // metodo POST para la creacion de una sede (se llama desde un formulario)
    public function crearSede(){
        // validar los datos de entrada
        $validacion = Validator::make( Input::all(), [
            'nombre' => 'required|unique:sede',
            'ciudad' => 'required'
            // campo direccion no es necesario
            // campo telefono no es necesario
        ]);
        // si la validacion falla, mostrar los mensajes de error
        if( $validacion->fails() )
            return Redirect::back()->withInput()->withErrors( $validacion->messages() );
        else{
            // si la validacion fue correcta, intentar crear la sede
//            dd( Input::all() );
            $sede = new Sede;
            $sede->nombre = Input::get('nombre');
            $sede->ciudad = Input::get('ciudad');
            $sede->direccion = Input::get('direccion');
            $sede->telefono = Input::get('telefono');
            $sede->save();
            // si se creo la sede, volver a cargar la vista
            return View::make('administrador.sedes')->with('creacionCorrecta', 1);
        }
    }

    public function carreras(){
        return View::make('administrador.carreras');
    }

    // metodo POST para la creacion de una Carrera (se llama desde un formulario)
    public function crearCarrera(){
        // validar los datos de entrada
        $validacion = Validator::make( Input::all(), [
            'codigo_sede' => 'required',
            'nombre' => 'required',
            'titulo' => 'required',
            'jornada' => 'required'
        ]);
        // si la validacion falla, mostrar los mensajes de error
        if( $validacion->fails() )
            return Redirect::back()->withInput()->withErrors( $validacion->messages() );
        else{
            // si la validacion fue correcta, intentar crear la sede
            $carrera = new Carrera;
            $carrera->codigo_sede = Input::get('codigo_sede');
            $carrera->nombre = Input::get('nombre');
            $carrera->titulo = Input::get('titulo');
            $carrera->jornada = Input::get('jornada');
            $carrera->save();
            // si se creo la sede, volver a cargar la vista
            return View::make('administrador.carreras')->with('creacionCorrecta', 1);
        }
    }
}


// cada vez que se muestre la siguiente vista, se cargaran datos desde la BD y se le entregaran para que los muestre
View::composer('administrador.sedes', function ($view) {
    // a la vista le entregamos todas las sedes en la BD
    $view->sedes = Sede::all();
});
View::composer('administrador.carreras', function ($view) {
    // a la vista le entregamos todas las Carreras, para mostrar en la tabla
    $view->carreras = Carrera::all();

    // entregamos las Sedes, para que sea agregado al combobox del formulario,
    // pero primero la mapeamos a otro formato:   array(codigo_sede=>nombre)
    $view->sedes = array();
    foreach( Sede::all() as $sede )
        $view->sedes[$sede->codigo_sede] = $sede->nombre;
});
