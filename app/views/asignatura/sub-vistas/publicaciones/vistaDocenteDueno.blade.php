@extends('asignatura.sub-vistas.publicaciones.vistaInvitados')

@section('opciones-publicacion-destacada')
    <div class="col-md-2">
        <a href="#" class="btn-destacar"><span class="glyphicon glyphicon-pushpin">Quitar</span></a>
    </div>
@stop

@section('opciones-publicacion')
    <div class="col-md-2">
        <a href="#" class="btn-destacar"><span class="glyphicon glyphicon-pushpin">Destacar</span></a>
    </div>
@stop


@section('footer')
    <script>
        $('.btn-destacar').on('click', function(evt){
            evt.preventDefault();
            var cod_pub = $(this).closest('article').data('codigo_publicacion');

            $.ajax({
                type: 'post',
                url:'{{ URL::to('destacarPublicacion/'.$asignatura->codigo_asignatura) }}',
                data: {
                    codigo_publicacion: cod_pub
                }
            }).done(function(resp){
                location.reload();
            });
        });
    </script>
@stop