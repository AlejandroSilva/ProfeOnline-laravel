@extends('layout.doscolumnas')

@section('columna-central')
    <div class="encabezado">
        @if( sizeof($asignaturas)==0 )
            <h1 class="titulo">No se encontraron asignaturas</h1>
        @else
            <h1 class="titulo">Asignaturas disponibles</h1>
        @endif
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
    {{ Form::open( array('url'=>'buscar/porNombre') ) }}
        <div class="row padding-top-1">
            <div class="col-md-10">
                {{ Form::text('nombre', '', array('class'=>'form-control', 'placeholder'=>'...por nombre') ) }}
            </div>
            <button type="submit" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-search"></span></button>
        </div>
    {{ Form::close() }}

    {{ Form::open( array('url'=>'buscar/porDocente') ) }}
        <div class="row padding-top-1">
            <div class="col-md-10">
                {{ Form::text('nombreDocente', '', array('class'=>'form-control', 'placeholder'=>'...por nombre de docente') ) }}
            </div>
            <button type="submit" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-search"></span></button>
        </div>
    {{ Form::close() }}
    <div class="row padding-top-1">
        <a href="{{ URL::to('/buscar') }}" class="btn btn-success col-md-4 col-md-offset-4">Ver todas</a>
    </div>
@stop
