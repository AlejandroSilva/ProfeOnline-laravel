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
}
