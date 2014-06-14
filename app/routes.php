<?php

// PAGINAS PUBLICAS
Route::get('registro', function(){
    return View::make('registro');
});

// PAGINA DE INICIO GENERICA, REDIRECCIONA SEGUN EL TIPO DE USUARIO
Route::get('/', function(){
    // si no esta logeado, mostrar la pagina HOME
    if( Auth::guest() )
        return View::make('home');
    elseif( Auth::user()->esAdministrador() )
        return 'Dashboard administrador '.Auth::user()->nombre;
    elseif( Auth::user()->esDocente() )
        return "Dashboard docente ".Auth::user()->nombre;
    elseif( Auth::user()->esAlumno() )
        return "Dashboard alumno ".Auth::user()->nombre;
    else{
        return "no existe una pagina de inicio para tu tipo de usuario, contacta al administrador";
    }
});

// CONTROL DE SESSIONES / LOGIN-LOGOUT
Route::get('login', 'SessionController@login');
Route::post('login', 'SessionController@validar');
Route::get('logout', 'SessionController@logout');


// PAGINAS DEL ADMINISTRADOR
Route::get('administracion/noautorizado', function(){
    return View::make('administrador.noautorizado');
});


// PRUEBAS
// solo puede acceder a esta ruta si paso por el filtro que verifica que sea administardor
Route::get('test', function(){
    return "Estoy logeado como Administrado!!  :D";
})->before('logeadoComoAdministrador');    // debe estar logeado como administrador