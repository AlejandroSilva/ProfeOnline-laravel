<?php

class SessionController extends \BaseController {

	public function login(){
        // si estoy logeado, ir a USUARIO.INICIO
        if( Auth::check() ){
            return Redirect::to('/admin');
        }
        // si no, mostrar el formulario para logear
        else{
            // TODO: mostrar un error al ingresar credenciales erroneas
            return View::make('Session.loginForm');
        }
	}
	public function validar(){
        // intentar logear
        if( Auth::attempt(Input::only('email', 'password')) ){
            return Redirect::to('/admin');
        }else{
            // TODO: retornnar un error al formulario de login
            return "fallo la autentificacion";
        }
	}
	public function logout(){
        // destruir la session
        Auth::logout();
        // volver al home
        return Redirect::to('/');
	}
}