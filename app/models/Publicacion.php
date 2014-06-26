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
}
