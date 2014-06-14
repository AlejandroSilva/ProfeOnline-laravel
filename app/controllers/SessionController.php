<?php

class SessionController extends \BaseController {

	public function login(){
        // si estoy logeado, ir a INICIO
        if( Auth::check() ){
            return Redirect::to('/');
        }
        // si no, mostrar el formulario para logear
        else{
            // TODO: mostrar un error al ingresar credenciales erroneas
            return View::make('loginForm');
        }
	}
	public function validar(){
        // si se LOGEO CORRECTAMENTE, ir a INICIO
        if( Auth::attempt(Input::only('email', 'password')) ){
            return Redirect::to('/');
        }
        else{
            // TODO: retornnar un error al formulario de login
            return "fallo la autentificacion";
        }
	}
	public function logout(){
        // destruir la session
        Auth::logout();
        // volver a INICIO
        return Redirect::to('/');
	}
}