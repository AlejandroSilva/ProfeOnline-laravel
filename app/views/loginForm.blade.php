@extends('layout.base')

@section('content')
    <div>
        <h1>Acceso a Profe Online</h1>
        {{ Form::open([
            'action'=>'SessionController@validar'
        ]) }}
        <div>
            {{ Form::label("email", "Correo electronico") }}
            {{ Form::input("email", "email") }}
            {{ $errors->first('email') }}
        </div>
        <div>
            {{ Form::label("password", "Contraseña") }}
            {{ Form::input("password", "password") }}
            {{ $errors->first('password') }}
        </div>
        <div>
            {{ Form::submit('Ingresar') }}
        </div>

        {{ Form::close() }}
    </div>
@stop