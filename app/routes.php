<?php

// PAGINAS PUBLICAS
Route::get('registro', function(){
    return View::make('registro');
});
Route::post('registro', 'SessionController@registro');
Route::get('noautorizado', function(){
    // definimos valores por defecto
    $titulo = "Acceso no permitido";
    $mensaje = "no puede acceder a esta pagina";
    // si nos Redirigieron y entregaron un titulo y/o un mensaje, los asignamos
    if( Session::has('titulo') )
        $titulo = Session::get('titulo');
    if( Session::has('mensaje') )
        $mensaje = Session::get('mensaje');
    // llamamos a la vista, con el titulo y el mensaje deseado
    return View::make('noautorizado')->withTitulo($titulo)->withMensaje($mensaje);
});

// mostrar la vista de una asignatura, dependiendo del tipo de usuario que la visite son las opciones que estaran disponibles
Route::get('asignatura/{cod_asig}', 'AlumnoController@ver_asignatura');
// ruta para suscribir al usuario logeado a una asignatura
Route::post('asignatura/{cod_asig}/suscribir', 'AlumnoController@suscribir')->before('auth');
// ruta para dar de baja al usuario logeado de una asignatura
Route::post('asignatura/{cod_asig}/dardebaja', 'AlumnoController@dardebaja')->before('auth');

// buscar las asignaturas existentes en el sistema
Route::get('buscar', 'AlumnoController@buscarTodas');

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
        return View::make('alumno/inicio');
    else{
        return "no existe una pagina de inicio para tu tipo de usuario, contacta al administrador";
    }
});

// CONTROL DE SESSIONES / LOGIN-LOGOUT
Route::get('login', 'SessionController@login');
Route::post('login', 'SessionController@validar');
Route::get('logout', 'SessionController@logout');


// PAGINAS DEL ADMINISTRADOR
// debe estar logeado como administrador para acceder a las siguientes rutas
Route::get('administracion/inicio', 'AdministradorController@inicio')->before('logeadoComoAdministrador');
Route::get('administracion/sedes', 'AdministradorController@sedes')->before('logeadoComoAdministrador');
Route::post('administracion/crearSede','AdministradorController@crearSede')->before('logeadoComoAdministrador');
Route::get('administracion/carreras', 'AdministradorController@carreras')->before('logeadoComoAdministrador');
Route::post('administracion/crearCarrera','AdministradorController@crearCarrera')->before('logeadoComoAdministrador');
Route::get('administracion/asignaturas', 'AdministradorController@asignaturas')->before('logeadoComoAdministrador');
Route::post('administracion/crearAsignatura','AdministradorController@crearAsignatura')->before('logeadoComoAdministrador');

// PAGINAS DEL DOCENTE
Route::get('docente/inicio', 'DocenteController@inicio')->before('logeadoComoDocente');
Route::get('docente/misAsignaturas', 'DocenteController@misAsignaturas')->before('logeadoComoDocente');

// PAGINAS DE LOS ALUMNOS
// listado de las asignaturas a las que esta suscrito
Route::get('asignaturas_suscritas', 'AlumnoController@suscritas')->before('auth');

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