@extends('layout.doscolumnas')

@section('columna-lateral')
<h3>Administración</h3>
<ul class="nav nav-pills nav-stacked">
    {{-- Si  esta en la ruta que preguntamos, agrega la clase "active" al elemento para que sea mas visible en el menu --}}
    <li class="{{ Request::is('administracion/inicio') ? 'active' : '' }}"><a href="{{URL::to('/')}}">Inicio</a></li>
    <li class="{{ Request::is('administracion/sedes') ? 'active' : '' }}"><a href="{{URL::action('AdministradorController@sedes')}}">Sedes</a></li>
    <li class="{{ Request::is('administracion/carreras') ? 'active' : '' }}"><a href="{{URL::action('AdministradorController@carreras')}}">Carreras</a></li>
</ul>
@stop