@extends('layout.administrador')

@section('columna-central')
<section>
    <div class="encabezado">
        <h1 class="titulo">Asignaturas</h1>
        <p>Estas son las Asignaturas existentes.... (continuar con la descripción)</p>
    </div>
</section>
<section>
    @if( isset($creacionCorrecta) )
    <h1>Asignatura agregada correctamente</h1>
    @else
    <h2>Crear nueva Asignatura</h2>
    {{ Form::open([
        "action"=>"AdministradorController@crearAsignatura"
    ]) }}
    <div>
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre') }}
        {{ $errors->first('nombre') }}
    </div>
    <div>
        {{ Form::label('anno', 'Año/Semestre') }}
        {{ Form::select('anno', array(
            '2014/2' => '2014/2',
            '2015/1' => '2015/1'
        ) ); }}
        {{ $errors->first('anno') }}
    </div>
    <div>
        {{ Form::label('codigo_carrera', 'Carrera a la que pertenece') }}
        {{ Form::select('codigo_carrera', $carreras) }}
        {{ $errors->first('codigo_carrera') }}
    </div>
    <div>
        {{ Form::submit("Crear Asignatura") }}
    </div>
    {{ Form::close() }}
    @endif
</section>
<section>
    <h2>Asignaturas Existentes</h2>
    <table id="tabla-carreras" class="table">
        <thead>
        <tr>
            <td>Codigo Asignatura</td>
            <td>Nombre</td>
            <td>Año</td>
            <td>Carrera</td>
        </tr>
        </thead>
        <tbody>
        @foreach ( $asignaturas as $asi)
        <tr>
            <td>{{ $asi->codigo_asignatura }}</td>
            <td>{{ $asi->nombre }}</td>
            <td>{{ $asi->anno }}</td>
            {{-- buscar la Carrera a la que pertenece la Asignatura, y mostrar su nombre --}}
            <td>{{ $asi->carrera->nombre }} </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</section>
@stop