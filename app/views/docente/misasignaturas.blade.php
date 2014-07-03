@extends('docente.base')

@section('columna-central')
    <div class="encabezado">
        <h1 class="titulo">Asignaturas que administra</h1>
    </div>
    @foreach( $asignaturas as $asig )
        <section class="margin-top-2">
            <div class="panel panel-asignatura margin-bottom-2 sombra">
                <div class="panel-heading">
                    <a href="{{ URL::to('asignatura/'.$asig->codigo_asignatura) }}">{{ $asig->nombre }}<span class="glyphicon glyphicon-circle-arrow-right pull-right"></span></a>
                </div>
                <div class="panel-footer">{{ $asig->getDocente()->nombre }}</div>
            </div>
        </section>
    @endforeach
@stop