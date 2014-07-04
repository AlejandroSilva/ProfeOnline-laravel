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

@section('footer')
    <script>
        $(function(){
            $('.panel-documentos>.panel-heading, .panel-documentos>.panel-footer, .mensaje-del-dia').on('click', function(evt){
                var $article_publicacion = $(this).closest('article');
                console.log(  );

                $.ajax({
                    type: 'post',
                    url:'{{ URL::to('verPublicacion') }}',
                    data: {
                        codigo_publicacion: $article_publicacion.data('codigo_publicacion')
                    }
                }).done(function(resp){
                    $article_publicacion.addClass('ya-visto');
                    console.log(resp);
                });

            });
        });
    </script>
@stop