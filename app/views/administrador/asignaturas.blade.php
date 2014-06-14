@extends('layout.doscolumnas')

@section('navbar-items')
<li class="active"><a href="{{URL::to('/')}}">Administracion</a></li>
@stop

@section('columna-lateral')
<h3>Administración</h3>
<ul class="nav nav-pills nav-stacked">
    <li><a href="{{URL::to('/')}}">Inicio</a></li>
    <li><a href="{{URL::action('AdministradorController@sedes')}}">Sedes</a></li>
    <li><a href="{{URL::action('AdministradorController@carreras')}}">Carreras</a></li>
    <li class="active"><a href="{{URL::action('AdministradorController@asignaturas')}}">Asignaturas</a></li>
</ul>
@stop

@section('columna-central')
    <h1>administrando asignaturas</h1>
@stop