@extends('layout.doscolumnas')

@section('columna-lateral')
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{URL::to('/')}}">Inicio</a></li>
    </ul>
@stop

@section('columna-central')
    <h1>Acceso no auttorizado</h1>
    <p>No tiene permiso para acceder a esta pagina, es solo visible para Administradores</p>
@stop
