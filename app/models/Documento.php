<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Documento extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    // The database table used by the model.
    protected $table = 'documento';

    // el primary key utilizado en la tabla
    protected $primaryKey = 'codigo_documento';

    // indicamos que no definimos los timestamps en la tabla
    public $timestamps = false;

    #referencia a otras tablas
    // Publicacion a la que el documento pertenecen
    public function publicacion(){
        // esta Publicacion, pertenece a una Asignatura
        return $this->belongsTo('publicacion', 'codigo_publicacion');
    }
}
