<?php

class DocenteController extends \BaseController {

    public function inicio(){
        return View::make('docente.inicio');
        //return Redirect::to('docente/misAsignaturas');
    }

    public function misAsignaturas(){
        return View::make('docente.misasignaturas');
    }
}
