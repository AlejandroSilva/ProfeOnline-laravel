@extends('layout.doscolumnas')

@section('columna-lateral')
    @include('asignatura.sub-vistas.lateral_misasignaturas', $suscripciones)
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