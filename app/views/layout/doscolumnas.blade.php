@extends('layout.base')

{{-- extiende al layout base y agrega dos columnas: una lateral para un menu, y otra principal para el contenido --}}

@section('content')
    <div class="row margin-top-2">
        <!-- menu -->
        <div class="col-md-3">
            @yield('columna-lateral')
        </div>
        <!-- columna central -->
        <div class="col-md-9">
            @yield('columna-central')
        </div>
    </div>
@stop