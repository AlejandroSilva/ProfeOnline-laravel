<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Suscripcion extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    // The database table used by the model.
    protected $table = 'suscripcion';

    // el primary key utilizado en la tabla
    protected $primaryKey = 'codigo_suscripcion';

    // indicamos que no definimos los timestamps en la tabla
    public $timestamps = false;

    public function asignatura(){
        // esta Suscripcion, esta asociada a UNA Asignatura
        return $this->belongsTo('Asignatura', 'codigo_asignatura', 'codigo_asignatura');
    }
    public function usuario(){
        // esta Suscripcion, esta asociada a UN Usuario
        return $this->belongsTo('User', 'codigo_usuario');
    }

    // entrega un listado de todas las publicaciones que no han sido vistas (los mas nuevos primero)
    public function publicaciones_no_vistas(){
        $codigo_suscripcion = $this->codigo_suscripcion;

        // obtener todas las publicaciones
        $publicaciones = $this->asignatura->publicaciones;

        // definir un arreglo para las publicaciones que no han sido vistas
        $publicacionesNoVistas = array();

        // recorrer la lista
        foreach($publicaciones as $publicacion){
            // obtener el estado de la Publicacion para esta Suscripcion
            $estadoSuscripcion = EstadoPublicacion::where('codigo_suscripcion', '=', $codigo_suscripcion)->where('codigo_publicacion', '=', $publicacion->codigo_publicacion)->first();
            // si no ha sido vista, agregar al arreglo
            if($estadoSuscripcion==null){
                array_push($publicacionesNoVistas, $publicacion);
            }
        }

        // retornar las publicaciones no vistas (de mas nuevas a mas antiguas)
        return array_reverse($publicacionesNoVistas);
    }
}
