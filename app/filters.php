<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('logeadoComoAdministrador', function(){
    // Si NO esta logeado, ir a la pagina de login
    if( Auth::guest() ){
        // redirigir a login
        return Redirect::guest('login');
    }
    else{
        // si esta logeado, pero no es Administrador
        if( Auth::user()->esAdministrador()==false ){
            //redirigir a una pagina con un error
            return Redirect::to('noautorizado')
                ->withTitulo('Acceso no autorizado')
                ->withMensaje('Debes identificarte como administrador para acceder a esta pagina.');
        }
        // si resulta ser administrador, no redirigir y continuar con la consulta
    }
});

Route::filter('logeadoComoDocente', function(){
    // Si NO esta logeado, ir a la pagina de login
    if( Auth::guest() ){
        // redirigir a login
        return Redirect::guest('login');
    }
    else{
        // si esta logeado, pero no es un Docente
        if( Auth::user()->esDocente()==false ){
            //redirigir a una pagina con un error
            return Redirect::to('noautorizado')
                ->withTitulo('Acceso no autorizado')
                ->withMensaje('Debes identificarte como Docente para acceder a esta pagina.');
        }
        // si resulta ser docente, no redirigir y continuar con la consulta
    }
});

Route::filter('duenoDeLaAsignatura', function($route, $request){
    // obtener el codigo de usuario y la asignatura
    $cod_asignatura = $route->getParameter('cod_asig');
    $asignatura = Asignatura::find($cod_asignatura);

    // si no ha sido encontrada, salir
    if($asignatura==null){
        return Redirect::to('asignatura404');
    }

    // si el usuario logeado no es el usuario dueño de la asignatura, salir con error
    if( Auth::user()->codigo_usuario != $asignatura->getDocente()->codigo_usuario ){
        return Redirect::to('noautorizado')
            ->withTitulo('Acceso no autorizado')
            ->withMensaje('Solo el Docente creador de esta asignatura puede acceder a esta pagina');
    }
});
