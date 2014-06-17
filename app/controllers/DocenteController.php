<?php

class DocenteController extends \BaseController {

    public function noautorizado(){
        return View::make('docente.noautorizado');
    }

    public function inicio(){
        return View::make('docente.inicio');
        //return Redirect::to('docente/misAsignaturas');
    }

    public function misAsignaturas(){
        return "mis asignaturas";
    }
}
