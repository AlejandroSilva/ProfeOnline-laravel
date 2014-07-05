@extends('layout.doscolumnas')

@section('columna-lateral')
    <h3>Mis asignaturas</h3>
    <ul class="nav nav-pills nav-stacked">
        @foreach( $suscripciones as $sus )
            <li class="">
                <a href="{{ URL::to('asignatura/'.$sus->asignatura->codigo_asignatura) }}">{{ $sus->asignatura->nombre}}
                    <span class="badge pull-right">{{ sizeof($sus->publicaciones_no_vistas()) }}</span>
                </a>
            </li>
        @endforeach
    </ul>
@stop

@section('columna-central')
    <div class="encabezado">
        <h1 class="titulo">Asignaturas suscritas</h1>
    </div>
    @foreach( $suscripciones as $sus )
        <section class="margin-top-2">
            <div class="panel panel-asignatura margin-bottom-2 sombra">
                <div class="panel-heading">
                    <a href="{{ URL::to('asignatura/'.$sus->asignatura->codigo_asignatura) }}">{{ $sus->asignatura->nombre }}<span class="glyphicon glyphicon-circle-arrow-right pull-right"></span></a>
                </div>
                <div class="panel-footer">{{ $sus->asignatura->getDocente()->nombre }}</div>
            </div>
        </section>
    @endforeach
@stop