<?php

class DocenteController extends \BaseController {

    public function inicio(){
        return View::make('docente.inicio');
        //return Redirect::to('docente/misAsignaturas');
    }

    public function misAsignaturas(){
        // obtenemos el listado de todas las suscipciones que administra
        $asignaturas = Auth::user()->asignaturasCreadas();

        // se las entregamos a la vista para que las muestre
        return View::make('docente.misasignaturas')->with('asignaturas', $asignaturas);
    }

    /*
 * Se hacen las validaciones para los siguientes metodos:
 * - el usuario esta logeado? (filtro "logeadoComoDocente")
 * - el usuario es docente? (filtro "logeadoComoDocente")
 * - El usuario es dueño de la publicacion/asignatura? (filtro "duenoDeLaAsignatura")
*/
    public function destacarPublicacion($codigo_asignatura){
        $codigo_publicacion = Input::get('codigo_publicacion');

        // obtener la publicacion deseada
        $publicacion = Publicacion::find($codigo_publicacion);
        if($publicacion==null){
            return Response::json( array('message'=>'no existe la publicacion que desea calificar'),400);  // bad request
        }

        // obtener la asignatura a la que pertenece la publicacion
        $asignatura = $publicacion->asignatura;

        // cualquier publicacion destacada anterior, ahora no lo es
        foreach( $asignatura->publicacionesDestacadas as $destacada ){
            $destacada->destacada = 0;
            $destacada->save();
        }

        // si la seleccionada es destacada, dejarla como normal
        if( $publicacion->destacada==1 ){
            return Response::json( array('message'=>'la publicacion ya no es destacada'), 200);  // bad request
        }else{
            // la publicacion seleccionada, es la nueva destacada
            $publicacion->destacada = 1;
            $publicacion->save();

            return Response::json( array('message'=>'la publicacion ha sido destacada') );
        }
    }

    public function formularioNuevaPublicacion($codigo_asignatura){
        $asignatura = Asignatura::find($codigo_asignatura);

        // si la asignatura no existe, mostrar una vista con el error
        if($asignatura==null)
            return Redirect::to('asignatura404');

        return View::make('asignatura.administrar.base')->with('asignatura', $asignatura)
            ->nest('sub_vista', 'asignatura.administrar.nuevaPublicacion', array('asignatura'=>$asignatura) );
    }

    public function postNuevaPublicacion($codigo_asignatura){
        // validar que la asignatura exista
        $asignatura = Asignatura::find($codigo_asignatura);
        if($asignatura==null)
            return Response::json("la asignatura no existe", 400);

        // validar los datos de entrada
        $validacion = Validator::make( Input::all(), [
            'titulo' => 'required',
            'mensaje' => 'required'
        ]);
        // si la validacion falla, mostrar los mensajes de error
        if( $validacion->fails() )
            return Response::json("los campos ingresados no son validos", 400);

        // crear la publicacion en la BD
        $publicacion = new Publicacion;
        $publicacion->titulo = Input::get('titulo');
        $publicacion->mensaje = Input::get('mensaje');
        $publicacion->codigo_asignatura = $codigo_asignatura;
        $publicacion->save();

        // entregar el codigo de la publicacion
        return Response::json(array(
            "estado"=>"creacion correcta",
            "codigo_publicacion"=>$publicacion->codigo_publicacion
        ), 200);
    }


    public function post_upload($codigo_publicacion){
        $file = Input::file('file');
        if($file==null){
            return Response::json('no se adjunto ningun archivo', 400);
        }
        // verificar que la publicacion exista
        $publicacion = Publicacion::find($codigo_publicacion);
        if($publicacion==null){
            return Response::json('la publicacion no existe', 400);
        }

        // generar el nombre del archivo en el servidor
        $carpetaDestino = public_path().'\\documentos\\'.$codigo_publicacion.'\\';
        $fileName = $file->getClientOriginalName();

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $nombreOriginal = pathinfo($fileName, PATHINFO_FILENAME);
        $nombreNuevo = $this->obtenerNuevoNombre($nombreOriginal, $extension, $carpetaDestino);

        // mover el documento creado al directorio publico
        $upload_success = $file->move($carpetaDestino, $nombreNuevo);
        if( $upload_success ) {
            // agregar a la base de datos el documento enviado
            $documento = new Documento;
            $documento->nombre = $nombreNuevo;
            $documento->url = 'documentos\\'.$codigo_publicacion.'\\'.$nombreNuevo;
            $documento->codigo_publicacion = $codigo_publicacion;
            $documento->save();

            return Response::json($documento->url, 200);
        } else {
            return Response::json('error, no se pudo enviar el documento', 400);
        }
    }

    // generar un nombre de archivo hasta que encuentre uno disponible (ej. "documento (3).txt")
    public function obtenerNuevoNombre($nombre, $extension, $carpetaDestino){
        $i = 1;
        $nombreNuevo = $nombre.'.'.$extension;
        while( File::exists($carpetaDestino.$nombreNuevo) )
            $nombreNuevo = $nombre.' ('.$i++.').'.$extension;
        return $nombreNuevo;
    }

    public function formularioNuevaAsignatura(){
        // entregamos las Carreras, para que sea agregado al combobox del formulario,
        // pero primero la mapeamos a otro formato:   array(codigo_carrera=>nombre)
        $carreras = array();
        foreach( Carrera::all() as $carrera )
            $carreras[$carrera->codigo_carrera] = $carrera->nombre;

        return View::make('docente.nuevaAsignatura')->with('carreras', $carreras);
    }
    public function post_nuevaAsignatura(){
        // validar los datos de entrada
        $validacion = Validator::make( Input::all(), [
            'codigo_carrera' => 'required',
            'nombre' => 'required',
            'anno' => 'required'
        ]);
        // si la validacion falla, mostrar los mensajes de error
        if( $validacion->fails() )
            return Redirect::back()->withInput()->withErrors( $validacion->messages() );
        else{
            // si la validacion fue correcta, intentar crear la sede
            $asignatura = new Asignatura;
            $asignatura->codigo_carrera = Input::get('codigo_carrera');
            $asignatura->nombre = Input::get('nombre');
            $asignatura->anno = Input::get('anno');
            $asignatura->save();

            // una vez creada la asignatura, se debe registrar el usuario actual como "Docente creador"
            $nuevaSuscripcion = new Suscripcion;
            $nuevaSuscripcion->codigo_usuario = Auth::user()->codigo_usuario;
            $nuevaSuscripcion->codigo_asignatura = $asignatura->codigo_asignatura;
            $nuevaSuscripcion->codigo_tipo_suscripcion = 1; // tipo "Creador"
            $nuevaSuscripcion->save();

            // si se creo correctamente, ir a la pagina de la nueva asignatura
            return Redirect::to('/asignatura/'.$asignatura->codigo_asignatura);
        }
    }
}
