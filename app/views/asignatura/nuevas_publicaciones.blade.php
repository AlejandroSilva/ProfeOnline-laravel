@extends('layout.doscolumnas')

@section('columna-central')
    <h1>Nuevas Publicaciones</h1>
    <section>
        @foreach( $suscripciones as $suscripcion)
            @foreach( $suscripcion->publicaciones_no_vistas() as $publicacion)
                <div class="panel panel-asignatura margin-bottom-2 sombra">
                    <div class="panel-heading">
                        <a href="{{ URL::to('asignatura/'.$publicacion->asignatura->codigo_asignatura.'#'.$publicacion->codigo_publicacion) }}">{{ $publicacion->titulo }}
                            <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                        </a>
                    </div>
                    <div class="panel-footer">Asignatura: {{ $publicacion->asignatura->nombre }}</div>
                </div>
            @endforeach
        @endforeach
     </section>
@stop

@section('columna-lateral')
    @include('asignatura.sub-vistas.lateral_misasignaturas', $suscripciones)
@stop