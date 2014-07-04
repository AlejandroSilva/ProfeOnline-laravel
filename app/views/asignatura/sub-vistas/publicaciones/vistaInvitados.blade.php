
{{-- MOSTRAR EL MENSAJE DEL DIA --}}
@foreach( $asignatura->publicacionesDestacadas()->get() as $publicacion )
    @include('asignatura.sub-vistas.mensaje_del_dia', $publicacion)
@endforeach

<section>
    {{-- MOSTRAR LOS DOCUMENTOS QUE HAN SIDO COMPARTIDOS POR EL DOCENTE --}}

    {{-- hack feo para asignar variables dentro de blade: --}}
    {{-- */   $publicaciones = $asignatura->publicacionesNormales()->get()  /* --}}
    @if( sizeof($publicaciones)==0 )
        <h3>Esta asignatura aún no tiene publicaciones</h3>
    @endif
    @foreach( $publicaciones as $publicacion )
        @include('asignatura.sub-vistas.publicacion', $publicacion)
    @endforeach
</section>