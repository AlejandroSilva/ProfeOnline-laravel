<?php

// PAGINAS PUBLICAS
Route::get('registro', function(){
    return View::make('registro');
});
Route::post('registro', 'SessionController@registro');

// PAGINA DE INICIO GENERICA, REDIRECCIONA SEGUN EL TIPO DE USUARIO
Route::get('/', function(){
    // si no esta logeado, mostrar la pagina HOME
    if( Auth::guest() )
        return View::make('home');
    elseif( Auth::user()->esAdministrador() )
        return Redirect::to('administracion/inicio');
    elseif( Auth::user()->esDocente() )
        return Redirect::to('docente/inicio');
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
// debe estar logeado como administrador para acceder a las siguientes rutas
Route::get('administracion/inicio', 'AdministradorController@inicio')->before('logeadoComoAdministrador');
Route::get('administracion/sedes', 'AdministradorController@sedes')->before('logeadoComoAdministrador');
Route::post('administracion/crearSede','AdministradorController@crearSede')->before('logeadoComoAdministrador');
Route::get('administracion/carreras', 'AdministradorController@carreras')->before('logeadoComoAdministrador');
Route::post('administracion/crearCarrera','AdministradorController@crearCarrera')->before('logeadoComoAdministrador');
Route::get('administracion/asignaturas', 'AdministradorController@asignaturas')->before('logeadoComoAdministrador');
Route::post('administracion/crearAsignatura','AdministradorController@crearAsignatura')->before('logeadoComoAdministrador');

// PAGINAS DEL DOCENTE
Route::get('docente/noautorizado', 'DocenteController@noautorizado');
Route::get('docente/inicio', 'DocenteController@inicio')->before('logeadoComoDocente');
Route::get('docente/misAsignaturas', 'DocenteController@misAsignaturas')->before('logeadoComoDocente');
Route::get('docente/suscritas', 'DocenteController@suscritas')->before('logeadoComoDocente');


// PADINAS DE LOS ALUMNOS
Route::get('alumno/suscritas', 'DocenteController@suscritas');   // temporal

// PRUEBAS
// solo puede acceder a esta ruta si paso por el filtro que verifica que sea administardor
Route::get('test', function(){
    return "Estoy logeado como Administrado!!  :D";
})->before('logeadoComoAdministrador');    // debe estar logeado como administrador

// obtener un parametro de una una url desde un Request
Route::get('/asigtest/{asig_id}', function($asig_id){
    var_dump( Request::is('asigtest/*') ); // verificar que este en una ruta, util para los menu
    var_dump( Request::segment(2) );  // el segundo elemento de la url, en nuestro caso, el ID
    return "esta url es un test";
});