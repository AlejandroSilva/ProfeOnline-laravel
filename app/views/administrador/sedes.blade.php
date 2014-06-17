@extends('layout.administrador')

@section('columna-central')
    <section>
        <div class="encabezado">
            <h1 class="titulo">Sedes</h1>
            <p>Estas son las sedes existentes.... (continuar con la descripción)</p>
        </div>
    </section>
    <section>
        @if( isset($creacionCorrecta) )
            <h1>Sede agregada correctamente</h1>
        @else
            <h2>Crear nueva Sede</h2>
            <!-- TODO: modificar el formulario utilizando Bootstrap -->
            {{ Form::open([
                'action'=>'AdministradorController@crearSede'
            ]) }}

                <div>
                {{ Form::label('nombre', 'Nombre') }}
                {{ Form::text('nombre') }}
                {{ $errors->first('nombre') }}
                </div>
                <div>
                    {{ Form::label('ciudad', 'Ciudad') }}
                    {{ Form::text('ciudad') }}
                    {{ $errors->first('ciudad') }}
                </div>
                <div>
                    {{ Form::label('direccion', 'Direccion') }}
                    {{ Form::text('direccion') }}
                    {{ $errors->first('direccion') }}
                </div>
                <div>
                    {{ Form::label('telefono', 'Telefono') }}
                    {{ Form::text('telefono') }}
                    {{ $errors->first('telefono') }}
                </div>
                {{ Form::submit('Crear Sede') }}
            {{ Form::close() }}
        @endif
    </section>
    <section>
        <h2>Sedes existentes</h2>
        <!-- TODO: modificar la tabla utilizando Bootstrap -->
        <table id="tabla-sedes" class="table">
            <thead>
            <tr>
                <td>Codigo Sede</td>
                <td>Nombre</td>
                <td>Ciudad</td>
                <td>Dirección</td>
                <td>Telefono</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($sedes as $sede)
                <tr>
                    <td>{{$sede->codigo_sede}}</td>
                    <td>{{$sede->nombre}}</td>
                    <td>{{$sede->ciudad}}</td>
                    <td>{{$sede->direccion}}</td>
                    <td>{{$sede->telefono}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@stop