<?php

// PAGINA DE INICIO GENERICA, REDIRECCIONA SEGUN EL TIPO DE USUARIO
Route::get('/', 'GenericController@inicio');

// VISTAS PUBLICAS
// buscar las asignaturas existentes en el sistema
Route::get('buscar', 'GenericController@mostrarTodas');
Route::post('buscar/porNombre', 'GenericController@post_buscarPorNombre');
Route::post('buscar/porDocente', 'GenericController@post_buscarPorDocente');
// mostrar la vista de una asignatura, dependiendo del tipo de usuario que la visite son las opciones que estaran disponibles
Route::get('asignatura/{cod_asig}', 'AlumnoController@ver_asignatura');


// VISTAS DE USUARIO
// listado de las asignaturas a las que esta suscrito
Route::get('asignaturas_suscritas', 'AlumnoController@suscritas')->before('auth');
// ruta para suscribir al usuario logeado a una asignatura
Route::post('asignatura/{cod_asig}/suscribir', 'AlumnoController@post_suscribir')->before('auth');
// ruta para dar de baja al usuario logeado de una asignatura
Route::post('asignatura/{cod_asig}/dardebaja', 'AlumnoController@post_dardebaja')->before('auth');


// PAGINAS DEL DOCENTE
Route::get('docente/inicio', 'DocenteController@inicio')->before('logeadoComoDocente');
// muestra las asignaturas que el docente ha creado
Route::get('docente/misAsignaturas', 'DocenteController@misAsignaturas')->before('logeadoComoDocente');

// CREACION DE ASIGNATURAS
Route::get('docente/nuevaAsignatura', 'DocenteController@formularioNuevaAsignatura')->before('logeadoComoDocente');
Route::post('docente/nuevaAsignatura', 'DocenteController@post_nuevaAsignatura')->before('logeadoComoDocente');


// GESTION DE PUBLICACIONES
// formulario para crear una nueva publicacion (solo para el docente creador)
Route::get('asignatura/{cod_asig}/nueva-publicacion', 'DocenteController@formularioNuevaPublicacion')->before('logeadoComoDocente')->before('duenoDeLaAsignatura');
// creacion de una nueva publicacion
Route::post('asignatura/{cod_asig}/nueva-publicacion', 'DocenteController@postNuevaPublicacion')->before('logeadoComoDocente')->before('duenoDeLaAsignatura');
// seleccionar una publicacion y marcarla como destacada (solo para el docente creador)
Route::post('destacarPublicacion/{cod_asig}', 'DocenteController@destacarPublicacion')->before('logeadoComoDocente')->before('duenoDeLaAsignatura');
// marca una publicacion como leida, solo para los usuarios suscritos a una asugnatura
Route::post('verPublicacion', 'AlumnoController@post_verPublicacion')->before('auth');
// envio de documentos al servidor
Route::post('upload/{cod_publicacion}', 'DocenteController@post_upload');


// PAGINAS DEL ADMINISTRADOR
// debe estar logeado como administrador para acceder a las siguientes rutas
Route::get('administracion/inicio', 'AdministradorController@inicio')->before('logeadoComoAdministrador');
Route::get('administracion/sedes', 'AdministradorController@sedes')->before('logeadoComoAdministrador');
Route::post('administracion/crearSede','AdministradorController@crearSede')->before('logeadoComoAdministrador');
Route::get('administracion/carreras', 'AdministradorController@carreras')->before('logeadoComoAdministrador');
Route::post('administracion/crearCarrera','AdministradorController@crearCarrera')->before('logeadoComoAdministrador');

// CONTROL DE SESSIONES / REGISTRO / LOGIN / LOGOUT
Route::get('login', 'SessionController@formulario_login');
Route::post('login', 'SessionController@post_login');
Route::get('logout', 'SessionController@logout');
Route::get('registro', 'SessionController@formulario_registro');
Route::post('registro', 'SessionController@post_registro');


// CONTROL DE ERRORES
Route::get('asignatura404', 'GenericController@asignaturaNoEncontrada');
Route::get('noautorizado','SessionController@noautorizado');