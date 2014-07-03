@extends('docente.base')

@section('columna-central')
    <article class="panel panel-documentos sombra">
        <div class="panel-heading">
            <h3 class="titulo">Nueva Asignatura</h3>
        </div>
        <div class="panel-body">

            <form id="fileupload" class="form-horizontal" method="POST" enctype="multipart/form-data" role="form">
            {{ Form::open() }}
                <div class="form-group">
                    {{ Form::label('nombre', 'Nombre', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('nombre', '', array( 'class'=>'form-control', 'placeholder'=>'nombre de la asignatura' )) }}
                    </div>
                    {{ $errors->first('nombre') }}
                </div>
                <div class="form-group">
                    {{ Form::label('codigo_carrera', 'Carrera', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                            {{ Form::select('codigo_carrera', $carreras, '1', array('class'=>'form-control')); }}
                    </div>
                    {{ $errors->first('codigo_carrera') }}
                </div>
                <div class="form-group">
                    {{ Form::label('anno', 'Año/Semestre', array('class'=>'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::select('anno', array('2014/2' => '2014/2', '2015/1' => '2015/1'), array( 'class'=>'form-control', 'disabled'=>'true' )) }}
                    </div>
                    {{ $errors->first('anno') }}
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Documentos</label>
                    <div class="col-sm-10">
                        <div class="col-md-12" id="div-publicar">
                            {{ Form::submit('Crear Asignatura', array('class'=>'btn btn-primary')) }}
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </article>
@stop