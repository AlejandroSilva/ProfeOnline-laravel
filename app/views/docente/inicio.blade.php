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
    <h1>hola, este es el inicio</h1>
@stop