<article class="panel panel-documentos sombra">
    <div class="panel-heading">
        <h3 class="titulo">Nueva Entrada</h3>
    </div>
    <div class="panel-body">

    <form id="fileupload" class="form-horizontal" method="POST" enctype="multipart/form-data" role="form">

        <div class="form-group">
          <label for="mod-titulo" class="col-sm-2 control-label">Titulo</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="mod-titulo" placeholder="Titulo">
          </div>
        </div>
        <div class="form-group">
          <label for="mod-mensaje" class="col-sm-2 control-label">Mensaje</label>
          <div class="col-sm-10">
            <textarea id="mod-mensaje" class="form-control textarea-fixed" placeholder="mensaje"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Documentos</label>
          <div class="col-sm-10">
            <!-- documentos -->
            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
              <div1 class="row fileupload-buttonbar">
                  <div class="col-md-12">
                      <!-- The fileinput-button span is used to style the file input field as button -->
                      <span class="btn btn-success fileinput-button">
                          <i class="glyphicon glyphicon-plus"></i>
                          <span>Agregar documentos...</span>
                          <input type="file" name="files[]" multiple="">
                      </span>
                      <div class="pull-right">
                        <button type="button" class="btn btn-danger delete">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Borrar todos</span>
                        </button>
                        <input type="checkbox" class="toggle">
                        <!-- The global file processing state -->
                        <span class="fileupload-process"></span>
                      </div>
                  </div>
                  <!-- The table listing the files available for upload/download -->
                  <div class="col-md-12">
                    <table role="presentation" class="table table-condensed"><tbody class="files"></tbody></table>
                  </div>
                  <div class="col-md-12" id="div-publicar">
                    <button type="submit" class="btn btn-primary start">
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Publicar entrada</span>
                    </button>

                    <button type="reset" class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancelar</span>
                    </button>
                  </div>
                  <!-- The global progress state -->
                  <div class="col-md-12 fileupload-progress fade">
                      <!-- The global progress bar -->
                      <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                          <div class="progress-bar progress-bar-success" style="width:0;"></div>
                      </div>
                      <!-- The extended global progress state -->
                      <div class="progress-extended">&nbsp;</div>
                  </div>
              </div1></div>
          </div>
    </form></div>
</article>