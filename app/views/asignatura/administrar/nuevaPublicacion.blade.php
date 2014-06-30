
<article class="panel panel-documentos sombra">

    <div class="panel-heading">
        <h3 class="titulo">Nueva Entrada</h3>
    </div>
    {{ Form::open(array(
        'id'=>'form-nueva-publicacion',
        'class'=>'form-horizontal',
        'action'=>'DocenteController@postNuevaPublicacion'
    )) }}
        <div class="panel-body">
            <div class="form-group">
                <label for="pub-titulo" class="col-sm-2 control-label">Titulo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pub-titulo" placeholder="Titulo" required>
                </div>
            </div>

            <div class="form-group">
                <label for="pub-mensaje" class="col-sm-2 control-label">Mensaje</label>
                <div class="col-sm-10">
                    <textarea id="pub-mensaje" class="form-control textarea-fixed" placeholder="mensaje" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Documentos</label>
                    <div class="col-sm-10">

                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        <div class="col-md-12 acciones">
                            <span class="btn btn-success btn-agregar dz-clickable">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Agregar documentos</span>
                            </span>
                        </div>

                        <div class="col-md-12">
                            <!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
                            <div class="table table-striped" class="files" id="previews">
                                <div id="template" class="file-row row">
                                    <!-- This is used as the file preview template -->
                                    <div class="col-md-2">
                                        <span class="preview"><img data-dz-thumbnail /></span>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="name" data-dz-name></p>
                                        <p class="size" data-dz-size></p>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- botones de publicar o cancelar entrada -->
                        <div class="col-md-12 acciones">
                            <button type="submit" class="btn btn-primary btn-publicar">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>Publicar entrada</span>
                            </button>
                            <button type="reset" class="btn btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>Cancelar</span>
                            </button>
                        </div>

                        <!-- Se muestra mientras se cargan los documentos -->
                        <div class="col-md-12 progreso" style="display: none;">
                            <span class="fileupload-process">
                                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                                </div>
                            </span>
                            <div class="alert alert-info" role="alert">
                              Creando la publicacion, espere y <strong>no cierre esta ventana</strong> hasta que se envien todos los documentos.
                            </div>
                        </div>
                        <!-- Se muestra una vez este creada la publicacion y enviados los documentos -->
                        <div class="col-md-12 completado" style="display: none;">
                            <div class="alert alert-success" role="alert">
                              <strong>¡Publicacion creada!</strong> La publicacion se ha creado correctamente
                            </div>
                            <a href="{{  URL::to('/asignatura/'.$asignatura->codigo_asignatura) }}" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-eye-open"></span> Ver publicacion</a>
                            <a href="{{  URL::to('/asignatura/'.$asignatura->codigo_asignatura.'/nueva-publicacion') }}" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Crear otra</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    {{ Form::close() }}
</article>

<script src="{{url('assets/vendor/dropzone.js')}}"></script>
<script src="{{url('assets/js/main-dropzone.js')}}"></script>
<script>
    var crearPublicacion = function(){
        var def = $.Deferred();
        $.ajax({
            type: "POST",
            url: "server/api-v1/sede",
            url:'{{ URL::to('/asignatura/'.$asignatura->codigo_asignatura.'/nueva-publicacion/') }}',
            data: {
                titulo: $('#pub-titulo').val(),
                mensaje: $('#pub-mensaje').val(),
            }
        })
        .done(function(resp){
            def.resolve(resp);
        })
        .fail(function(){
            def.reject();
        });
        return def;
    };

    // al hacer click en enviar... primero crear la publicacion
    $('#form-nueva-publicacion').on('submit', function(evt){
        console.log("enviando");
        evt.preventDefault();

        crearPublicacion().done(function(resp){
            // eliminar de la lista, todos los documentos con problemas
            myDropzone.getFilesWithStatus(Dropzone.ERROR).forEach(function(archivo){
                myDropzone.removeFile(archivo)
            });
            // bloqueamos el formulario
            bloquear_formulario();

            // obtenemos el codigo de la nueva publicacion
            var codigo_publicacion = resp.codigo_publicacion;

            // cambiar la url en donde entregara los documentos
            window.myDropzone.options.url = "http://localhost/ProfeOnline-laravel/public/upload/" + codigo_publicacion;
            // si existen... comenzar a enviar los documentos
            if( myDropzone.files.length>0 )
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
            else
                publicacion_terminada();
        }).fail(function(){
            console.log("ocurrio un problema con la creacion de la publicacion");
        });
    });

    $('#form-nueva-publicacion').on('reset', function(){
        // quitar los documentos adjuntados
        myDropzone.removeAllFiles(true);
        // resetear el formulario
        resetear_formulario();
    });

    var bloquear_formulario = function(){
        // bloquear las acciones
        $(".acciones").hide();
        // mostrar el progreso
        $('.progreso').show();
    };
    var resetear_formulario = function(){
        $('.fileupload-process').hide();
    }
    var publicacion_terminada = function(){
        // bloquear las acciones
        $(".acciones").hide();
        // ocultar el progreso
        $('.progreso').hide();
        // ocultar los documentos enviados
        myDropzone.removeAllFiles(true);
        // mostrar el mensaje final
        $('.completado').show();
    }
</script>