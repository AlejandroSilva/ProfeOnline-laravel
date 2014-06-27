@extends('layout.doscolumnas')

@section('columna-central')
    <section>
        <div class="encabezado">
            <h1 class="titulo">{{ $asignatura->nombre }}</h1>

            @yield('opciones-encabezado')

            <p>Profesor: <a href="FALTA-POR-DEFINIR">{{ $asignatura->getDocente()->nombre }}</a></p>
        </div>

        {{-- MOSTRAR EL MENSAJE DEL DIA --}}
        @foreach( $asignatura->publicacionesDestacadas()->get() as $publicacion )
            <article class="mensaje-del-dia importante sombra" data-codigo_publicacion="{{ $publicacion->codigo_publicacion}}">
                <div class="row">
                    <h2 class="col-md-10"><span class="glyphicon glyphicon-info-sign"></span>{{ $publicacion->titulo }}</h2>
                    @yield('opciones-publicacion-destacada')
                </div>
                <p>{{ $publicacion->mensaje }}</p>
            </article>
        @endforeach

        <section>
            {{-- MOSTRAR LOS DOCUMENTOS QUE HAN SIDO COMPARTIDOS POR EL DOCENTE --}}

            {{-- hack feo para asignar variables dentro de blade: --}}
            {{-- */   $publicaciones = $asignatura->publicacionesNormales()->get()  /* --}}
            @if( sizeof($publicaciones)==0 )
                <h3>Esta asignatura aún no tiene publicaciones</h3>
            @endif
            @foreach( $publicaciones as $publicacion )
                <article class="panel panel-documentos sombra" data-codigo_publicacion="{{ $publicacion->codigo_publicacion}}">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="titulo col-md-10">{{ $publicacion->titulo }}</h3>
                            @yield('opciones-publicacion')
                        </div>
                        <p class="descripcion">{{ $publicacion->mensaje }}</p>
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
                            <div class="col-md-4">
                                <span class="glyphicon glyphicon-calendar"></span> Publicado: {{ $publicacion->created_at }}
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
@stop