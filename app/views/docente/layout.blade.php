@extends('layout.doscolumnas')

@section('navbar-items')
    <li class="active"><a href="{{URL::to('/')}}">Inicio</a></li>
    <li class="active"><a href="{{URL::to('/')}}">Buscar</a></li>
    <li class="active"><a href="{{URL::to('/docente/suscritas')}}">Suscritas</a></li>
    <li class="active"><a href="{{URL::to('/docente/misAsignaturas')}}">MisAsignaturas</a></li>
@stop