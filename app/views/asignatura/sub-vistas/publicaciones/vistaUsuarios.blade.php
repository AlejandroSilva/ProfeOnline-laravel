@extends('asignatura.sub-vistas.publicaciones.vistaInvitados')

@section('opciones-encabezado')
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
@stop