<?php

class AdministradorController extends \BaseController {

    public function inicio(){
        return View::make('administrador.inicio');
    }

    public function sedes(){
        return View::make('administrador.sedes');
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
    //$view->recentPosts = Post::orderBy('id', 'desc')->take(5)->get();
    //$view->with('count', User::count());

    //$view->with('mensaje', 'este es un mensaje');
    $view->usuarios= User::all();
});