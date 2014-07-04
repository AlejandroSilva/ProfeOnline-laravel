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
</article>