    <h3>Asignaturas suscritas</h3>
    <ul class="nav nav-pills nav-stacked">
        @foreach( $suscripciones as $sus )
            <li class="{{ Request::is('asignatura/'.$sus->asignatura->codigo_asignatura) ? 'active' : '' }}">
                <a href="{{ URL::to('asignatura/'.$sus->asignatura->codigo_asignatura) }}">{{ $sus->asignatura->nombre}}
                    {{-- hack feo para asignar variables dentro de blade: --}}
                    {{-- */   $contador = sizeof($sus->publicaciones_no_vistas())  /* --}}
                    @if( $contador>0 )
                        <span class="badge pull-right">{{ $contador }}</span>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>