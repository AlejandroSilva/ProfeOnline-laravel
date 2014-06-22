@extends('layout.doscolumnas')

@section('columna-central')
    <section>
        <div class="encabezado">
            <h1 class="titulo">{{ $asignatura->nombre }}</h1>

            {{-- si esta logeado, mostrar alguna de las opciones --}}
            @if( Auth::check() )
                {{-- Si el usuario logeado es el Docente que creo la asignatura, entonces puede Configurar, Enviar documentos, etc. --}}
                @if( Auth::user()->codigo_usuario==$docente->codigo_usuario )
                    <div class="opciones">
                        <a class="btn">Enviar <span class="glyphicon glyphicon-cloud-upload"></span></a>
                        <a class="btn">Administrar <span class="glyphicon glyphicon-cog"></span></a>
                    </div>
                @else
                    {{-- Si esta suscrito, puede darse de baja. Si no, entonces puede suscribirse--}}
                    @if( Auth::user()->estaSuscritoA( $asignatura->codigo_asignatura )==true )
                        {{ Form::open(array(
                        'url'=>'asignatura/'.$asignatura->codigo_asignatura.'/dardebaja',
                            'class'=>'form-suscribir'
                        )) }}
                        {{ Form::submit('Dar de Baja', array('class'=>'btn btn-warning suscribete') ) }}
                        {{ $errors->first('error') }}
                        {{ Form::close()  }}
                    @else
                        {{ Form::open(array(
                            'url'=>'asignatura/'.$asignatura->codigo_asignatura.'/suscribir',
                            'class'=>'form-suscribir'
                        )) }}
                        {{ Form::submit('Suscribir', array('class'=>'btn btn-success suscribete') ) }}
                        {{ $errors->first('error') }}
                        {{ Form::close()  }}
                    @endif
                @endif
            @endif
            {{-- si no esta logeado, no puede realizar ninguna accion... --}}
            <p>Profesor: <a href="FALTA-POR-DEFINIR">{{ $docente->nombre }}</a></p>
        </div>

        {{-- MOSTRAR EL MENSAJE DEL DIA --}}
        <div class="mensaje-del-dia importante sombra">
            <h2><span class="glyphicon glyphicon-info-sign"></span>MENSAJE DEL DIA</h2>
            <p>ESTE ES UN MENSAJE DEL DIA, UN MENSAJE "STICKY" DEL DOCENTE A SUS ALUMNOS...</p>
        </div>

        <section>
            {{-- MOSTRAR LOS DOCUMENTOS QUE HAN SIDO COMPARTIDOS POR EL DOCENTE --}}
            <article class="panel panel-documentos sombra">
                <div class="panel-heading">
                    <h3 class="titulo">Modulo 3: Aislantes</h3>
                    <p class="descripcion">Los documentos para la proxima prueba</p>
                </div>
                <div class="panel-body">
                    <div class="tabla">
                        <div class="tabla-row">
                            <p class="nombre-doc">9- AISLANTES.pdf</p><a href="#" class="link-doc">
                            <span class="glyphicon glyphicon-cloud-download">descargar</span></a>
                        </div>
                        <div class="tabla-row">
                            <p class="nombre-doc">10- EFECTO JOULE.pdf</p><a href="#" class="link-doc">
                            <span class="glyphicon glyphicon-cloud-download">descargar</span></a>
                        </div>
                        <div class="tabla-row">
                            <p class="nombre-doc">11- LEY DE OHM.pdf</p><a href="#" class="link-doc">
                            <span class="glyphicon glyphicon-cloud-download">descargar</span></a>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-8">
                            <p><span class="glyphicon glyphicon-tags"></span> Tags:
                                <span class="label label-info">resistividad</span>
                                <span class="label label-info">electricidad</span>
                                <span class="label label-info">campos</span>
                                <span class="label label-info">aislantes</span>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <span class="glyphicon glyphicon-calendar"></span> Publicado: 23-03-2014
                        </div>
                    </div>
                </div>
            </article>
        </section>
@stop