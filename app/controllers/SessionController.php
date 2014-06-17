<?php

class SessionController extends \BaseController {

    // post para crear un usuario
    public function registro(){
        // reglas para validar que el nuevo usuario sea valido
        $validacion = Validator::make( Input::all(), [
            'nombre' => 'required',
            'email' => 'required|unique:usuario',           // valida que el correo no exista en la base de datos
            'password' => 'required',
            'codigo_tipo_usuario' => 'required'
        ]);
        // si la validacion falla, retornar a la vista del formulario e indicar los errores
        if( $validacion->fails() ){
            return Redirect::back()->withInput()->withErrors( $validacion->messages() );
        }
        else{
            // crear el usuario y guardarlo en la BD
            $usuario = new User;
            $usuario->nombre = Input::get('nombre');
            $usuario->email = Input::get('email');
            $usuario->password = Hash::make( Input::get('password') );
            $usuario->codigo_tipo_usuario = Input::get('codigo_tipo_usuario');
            $usuario->save();

            // mostrar la vista de registro completo
            return View::make('registroCompletado');
        }
    }

	public function login(){
        // si estoy logeado, ir a INICIO
        if( Auth::check() ){
            return Redirect::to('/');
        }
        // si no, mostrar el formulario para logear
        else{
            return View::make('loginForm');
        }
	}
	public function validar(){
        // validar los datos de entrada
        $validacion = Validator::make( Input::all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        // si la validacion falla, mostrar los mensajes de error
        if( $validacion->fails() )
            return Redirect::back()->withInput()->withErrors( $validacion->messages() );
        else{
            // si la validacion fue correcta, intentar logear
            // si se LOGEO CORRECTAMENTE, ir a INICIO
            if( Auth::attempt(Input::only('email', 'password')) ){
                return Redirect::to('/');
            }
            else{
                // error: el usuario o contraseña no son validos
                return Redirect::back()->withInput()->withErrors(array('email' => 'Usuario o contraseña invalidos'));
            }
        }
	}
	public function logout(){
        // destruir la session
        Auth::logout();
        // volver a INICIO
        return Redirect::to('/');
	}
}