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
        return $this->belongsTo('Asignatura', 'codigo_asignatura');
    }
    public function usuario(){
        // esta Suscripcion, esta asociada a UN Usuario
        return $this->belongsTo('User', 'codigo_usuario');
    }
}
