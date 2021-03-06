@if($publicacion->haSidoVista() )
    <article class="panel panel-documentos ya-visto" data-codigo_publicacion="{{ $publicacion->codigo_publicacion}}" id="{{ $publicacion->codigo_publicacion}}">
@else
    <article class="panel panel-documentos sombra" data-codigo_publicacion="{{ $publicacion->codigo_publicacion}}" id="{{ $publicacion->codigo_publicacion}}">
@endif

    <div class="panel-heading">
        <div class="row">
            <h3 class="titulo col-md-10">{{ $publicacion->titulo }}</h3>
            @yield('opciones-publicacion')
        </div>
        <p class="descripcion">{{ $publicacion->mensaje }}</p>
    </div>
    {{-- hack feo para asignar variables dentro de blade: --}}
    {{-- */   $documentos = $publicacion->documentos()->get()  /* --}}
    @if( sizeof($documentos)!=0 )
    <div class="panel-body">
        <div class="tabla">
            @foreach( $documentos as $documento )
            <div class="tabla-row">
                <p class="nombre-doc">{{ $documento->nombre }}</p><a href="#" class="link-doc">
                    <a href="{{ URL::to($documento->url) }}" target="_blank"><span class="glyphicon glyphicon-cloud-download">descargar</span></a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
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