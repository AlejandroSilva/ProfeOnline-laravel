@extends('layout.doscolumnas')

@section('columna-lateral')
    <h3>Menu Docencia</h3>
    <ul class="nav nav-pills nav-stacked">
        <li class="{{ Request::is('docente/inicio') ? 'active' : '' }}"><a href="{{URL::to('/')}}">Inicio</a></li>
        <li class="{{ Request::is('docente/misAsignaturas') ? 'active' : '' }}"><a href="{{URL::to('/docente/misAsignaturas')}}">Asignaturas Creadas</a></li>
        <li class="{{ Request::is('asignaturas_suscritas') ? 'active' : '' }}"><a href="{{URL::to('/asignaturas_suscritas')}}">Asignaturas Suscritas</a></li>
        <li class="{{ Request::is('docente/nuevaAsignatura') ? 'active' : '' }}"><a href="{{URL::to('/docente/nuevaAsignatura')}}">Nueva Asignatura</a></li>
    </ul>
@stop