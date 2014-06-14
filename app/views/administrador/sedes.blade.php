@extends('layout.doscolumnas')

@section('navbar-items')
<li class="active"><a href="{{URL::to('/')}}">Administracion</a></li>
@stop

@section('columna-lateral')
<h3>Administración</h3>
<ul class="nav nav-pills nav-stacked">
    <li><a href="{{URL::to('/')}}">Inicio</a></li>
    <li class="active"><a href="{{URL::action('AdministradorController@sedes')}}">Sedes</a></li>
    <li><a href="{{URL::action('AdministradorController@carreras')}}">Carreras</a></li>
    <li><a href="{{URL::action('AdministradorController@asignaturas')}}">Asignaturas</a></li>
</ul>
@stop

@section('columna-central')
    <section>
        <div class="encabezado">
            <h1 class="titulo">Sedes</h1>
            <p>Estas son las sedes existentes.... (continuar con la descripción)</p>
            {{ $usuarios }}
        </div>
    </section>

    <section>
        <h2>Crear nueva Sede</h2>
        <!-- TODO: modificar el formulario utilizando Bootstrap -->
        <form action="post" id="form-sedes">
            <label for="in-nombre">Nombre</label>
            <input type="text" id="in-nombre" min=2>
            <br>
            <label for="in-ciudad">Ciudad</label>
            <input type="text" id="in-ciudad">
            <br>
            <label for="in-direccion">Dirección</label>
            <input type="text" id="in-direccion">
            <br>
            <label for="in-telefono">Telefono</label>
                <input type="text" id="in-telefono">
                <br>
                <input type="submit">
        </form>
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
            </tbody>
        </table>
    </section>
@stop