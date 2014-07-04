@if($publicacion->haSidoVista() )
    <article class="mensaje-del-dia importante ya-visto sombra" data-codigo_publicacion="{{ $publicacion->codigo_publicacion}}">
@else
    <article class="mensaje-del-dia importante sombra" data-codigo_publicacion="{{ $publicacion->codigo_publicacion}}">
@endif
    <div class="row">
        <h2 class="col-md-10"><span class="glyphicon glyphicon-info-sign"></span>{{ $publicacion->titulo }}</h2>
        @yield('opciones-publicacion-destacada')
    </div>
    <p>{{ $publicacion->mensaje }}</p>
    {{-- hack feo para asignar variables dentro de blade: --}}
    {{-- */   $documentos = $publicacion->documentos()->get()  /* --}}
    <div class="row">
        <div class="tabla">
            @foreach( $documentos as $documento )
            <div class="tabla-row">
                <p class="nombre-doc">{{ $documento->nombre }}</p><a href="#" class="link-doc">
                    <a href="{{ URL::to($documento->url) }}" target="_blank"><span class="glyphicon glyphicon-cloud-download">descargar</span></a>
            </div>
            @endforeach
        </div>
    </div>
</article>