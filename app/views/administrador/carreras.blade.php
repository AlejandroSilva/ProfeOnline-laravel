@extends('layout.administrador')

@section('columna-central')
    <section>
        <div class="encabezado">
            <h1 class="titulo">Carreras</h1>
            <p>Estas son las Carreras existentes.... (continuar con la descripción)</p>
        </div>
    </section>
    <section>
        @if( isset($creacionCorrecta) )
            <h1>Carrera agregada correctamente</h1>
        @else
        <h2>Crear nueva Carrera</h2>
            {{ Form::open([
                "action"=>"AdministradorController@crearCarrera"
            ]) }}
                <div>
                    {{ Form::label('nombre', 'Nombre') }}
                    {{ Form::text('nombre') }}
                    {{ $errors->first('nombre') }}
                </div>
                <div>
                    {{ Form::label('titulo', 'Titulo a otorgar') }}
                    {{ Form::text('titulo') }}
                    {{ $errors->first('titulo') }}
                </div>
                <div>
                    {{ Form::label('jornada', 'Jornada') }}
                    {{ Form::select('jornada', array(
                        'Diurna' => 'Diurna',
                        'Vespertina' => 'Vespertina'
                    ), 'Diurna'); }}
                    {{ $errors->first('jornada') }}
                </div>
                <div>
                    {{ Form::label('codigo_sede', 'Sede en la que se imparte') }}
                    {{ Form::select('codigo_sede', $sedes) }}
                    {{ $errors->first('codigo_sede') }}
                </div>
                <div>
                    {{ Form::submit("Crear Carrera") }}
                </div>
            {{ Form::close() }}
        @endif
    </section>
    <section>
        <h2>Carreras Existentes</h2>
        <table id="tabla-carreras" class="table">
            <thead>
            <tr>
                <td>Codigo Carrera</td>
                <td>Nombre</td>
                <td>Titulo</td>
                <td>Jornada</td>
                <td>Sede</td>
            </tr>
            </thead>
            <tbody>
            {{-- $sede = Carrera::find(5)->sede --}}
            {{-- var_dump( $sede ) --}}
            @foreach ($carreras as $carrera)
            <tr>
                <td>{{$carrera->codigo_carrera}}</td>
                <td>{{$carrera->nombre}}</td>
                <td>{{$carrera->titulo}}</td>
                <td>{{$carrera->jornada}}</td>
                {{-- buscar la Sede a la que pertenece la Carrera, y mostrar su nombre --}}
                <td>{{$carrera->sede->nombre}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@stop