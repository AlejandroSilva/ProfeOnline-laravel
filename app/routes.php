<?php

// PAGINAS PUBLICAS
Route::get('/', function(){
	return View::make('home');
});
Route::get('registro', function(){
    return View::make('registro');
});

// CONTROL DE SESSIONES / LOGIN-LOGOUT
Route::get('login', 'SessionController@login');
Route::post('login', 'SessionController@validar');
Route::get('logout', 'SessionController@logout');

// PAGINAS DEL ADMINISTRADOR
Route::get('admin', function(){
    if( Auth::check() ){
        return " Bienvenido ".Auth::user()->nombre;
        //return "mostrar el dashboard del usuario";
    }
})->before('auth'); // si no esta logeado, envia a "/login"
