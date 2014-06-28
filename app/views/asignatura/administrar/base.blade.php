@extends('asignatura.base')

@section('opciones-encabezado')
    <div class="opciones">
        <a class="btn">Enviar <span class="glyphicon glyphicon-cloud-upload"></span></a>
        <a class="btn">Administrar <span class="glyphicon glyphicon-cog"></span></a>
    </div>
@stop

@section('columna-lateral')
    @section('columna-lateral')
    <h3>Administrar asignatura</h3>
    <ul class="nav nav-pills nav-stacked">
        {{-- Si  esta en la ruta que preguntamos, agrega la clase "active" al elemento para que sea mas visible en el menu --}}
        <li class="{{ Request::is('asignatura/'.$asignatura->codigo_asignatura) ? 'active' : '' }}"><a href="{{  URL::to('/asignatura/'.$asignatura->codigo_asignatura) }}">Publicaciones </a></li>
        <li class="{{ Request::is('asignatura/'.$asignatura->codigo_asignatura.'/nueva-publicacion') ? 'active' : '' }}"><a href="{{  URL::to('/asignatura/'.$asignatura->codigo_asignatura.'/nueva-publicacion') }}">Nueva Publicacion</a></li>
    </ul>
    @stop
@stop