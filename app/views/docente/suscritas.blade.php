@extends('docente.layout')

@section('columna-lateral')
    <h3>Mis asignaturas</h3>
    <ul class="nav nav-pills nav-stacked">
        <li class=""><a href="{{URL::to('/')}}">Elemento</a></li>
        <li class=""><a href="{{URL::to('/')}}">Elemento</a></li>
        <li class=""><a href="{{URL::to('/')}}">Elemento</a></li>
        <li class=""><a href="{{URL::to('/')}}">Elemento</a></li>
    </ul>
@stop

@section('columna-central')
    <div class="encabezado">
        <h1 class="titulo">Asignaturas suscritas</h1>
    </div>
    @foreach( $asignaturas as $asig )
        <section class="margin-top-2">
            <div class="panel panel-asignatura margin-bottom-2 sombra">
                <div class="panel-heading"><a href="URL--PENDIENTE">{{ $asig->nombre }}<span class="glyphicon glyphicon-circle-arrow-right pull-right"></span></a></div>
                <div class="panel-footer">{{ $asig->docente->nombre }}</div>
            </div>
        </section>
    @endforeach
@stop