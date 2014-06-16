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

    public function asignaturas(){
        return View::make('administrador.asignaturas');
    }
}


// cada vez que se muestre la siguiente vista, se cargaran datos desde la BD y se le entregaran para que los muestre
View::composer('administrador.sedes', function ($view) {
    // a la vista le entregamos todas las sedes en la BD
    $view->sedes = Sede::all();
});