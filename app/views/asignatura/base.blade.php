@extends('layout.doscolumnas')

@section('columna-central')
    <section>
        <div class="encabezado">
            <h1 class="titulo">{{ $asignatura->nombre }}</h1>

            @yield('opciones-encabezado')

            <p>Profesor: <a href="FALTA-POR-DEFINIR">{{ $asignatura->getDocente()->nombre }}</a></p>
        </div>
     </section>

     <section>
         {{-- utilizado para cargar sub-vistas ---}}
         {{ $sub_vista }}
     </section>
@stop