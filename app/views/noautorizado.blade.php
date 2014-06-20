@extends('layout.doscolumnas')

@section('columna-lateral')
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{URL::to('/')}}">Inicio</a></li>
    </ul>
@stop

@section('columna-central')
    <h1>{{ $titulo }}</h1>
    <p>{{ $mensaje }}</p>
@stop
