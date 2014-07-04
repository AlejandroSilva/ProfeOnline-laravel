<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Publicacion extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    // The database table used by the model.
    protected $table = 'publicacion';

    // el primary key utilizado en la tabla
    protected $primaryKey = 'codigo_publicacion';

    // vamos a utilizar timestamps para obtener la fecha/hora de creacion y modificacion de una publicacion
    public $timestamps = true;

    #referencia a otras tablas
    // ASIGNATURA a la que las publicaciones pertenecen
    public function asignatura(){
        // esta Publicacion, pertenece a una Asignatura
        return $this->belongsTo('Asignatura', 'codigo_asignatura');
    }

    // Documentos que estan asociados a esta Publicacion
    public function documentos(){
        return $this->hasMany('documento', 'codigo_publicacion');
    }

    public function haSidoVista(){
        if( Auth::check() ){
            $usuario = Auth::user();
            $asignatura = $this->asignatura;
            // Si el usuario logeado es el Docente que creo la asignatura, se marcan como NO vistas (solo porque esteticamente es mas comodo)
            if( $usuario->codigo_usuario == $asignatura->getDocente()->codigo_usuario ) {
                return false;
            }
            else{
                // obtener suscripcion
                $suscripcion = Suscripcion::where('codigo_usuario', '=', $usuario->codigo_usuario)
                    ->where('codigo_asignatura', '=', $asignatura->codigo_asignatura)->first();

                // si el usuario NO esta suscrito, se marcan todas como NO vista
                if($suscripcion==null) {
                    return false;
                }
                else{
                    // veriricar que que la publicacion ya haya sido vista por el usuario
                    $estadoPublicacion = EstadoPublicacion::where('codigo_suscripcion', '=', $suscripcion->codigo_suscripcion)->where('codigo_publicacion', '=', $this->codigo_publicacion)->first();
                    if($estadoPublicacion==null){
                        // publicacion NO vista
                        return false;
                    }
                    else{
                        // publicacion HA SIDO vista
                        return true;
                    }
                }
            }
        }
        else{
            // si no esta logeado, se marcan como NO vistas
            return false;
        }
    }
}
