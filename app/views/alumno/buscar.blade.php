@extends('layout.doscolumnas')

@section('columna-central')
    <div class="encabezado">
        <h1 class="titulo">Asignaturas disponibles</h1>
    </div>
    @foreach( $asignaturas as $asig )
    <section class="margin-top-2">
        <div class="panel panel-asignatura margin-bottom-2 sombra">
            <div class="panel-heading"><a href="asignatura/{{ $asig->codigo_asignatura }}">{{ $asig->nombre }}<span class="glyphicon glyphicon-circle-arrow-right pull-right"></span></a></div>
            <div class="panel-footer">{{ $asig->getDocente()->nombre }}</div>
        </div>
    </section>
    @endforeach
@stop

@section('columna-lateral')
    <h3>Filtrar por:</h3>
    <div class="row padding-top-1">
        <div class="col-md-10">
        <input type="text" class="form-control" placeholder="...por nombre">
    </div>
        <button type="submit" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-search"></span></button>
    </div>
    <div class="row padding-top-1">
        <div class="col-md-10">
            <input type="text" class="form-control" placeholder="...por profesor">
        </div>
        <button type="submit" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-search"></span></button>
    </div>
@stop