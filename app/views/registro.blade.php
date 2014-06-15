@extends('layout.base')

@section('content')
    <h1>Registro</h1>

    {{ Form::open() }}
    <div>
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre') }}
        {{ $errors->first('nombre') }}
    </div>
    <div>
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email') }}
        {{ $errors->first('email') }}
    </div>
    <div>
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password') }}
        {{ $errors->first('password') }}
    </div>
    <div>
        {{ Form::label('codigo_tipo_usuario', 'Tipo de usuario') }}
        {{-- Form::text('codigo_tipo_usuario') --}}
        {{ Form::select('codigo_tipo_usuario', array(
            '1' => 'Administrador',
            '2' => 'Docente',
            '3' => 'Alumno'
        ), '3'); }}
        {{ $errors->first('codigo_tipo_usuario') }}
    </div>
    <div>
        {{ Form::submit('registrar') }}
    </div>

    {{ Form::close() }}

@stop