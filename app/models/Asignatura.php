<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Asignatura extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    // The database table used by the model.
    protected $table = 'asignatura';

    // el primary key utilizado en la tabla
    protected $primaryKey = 'codigo_asignatura';

    // indicamos que no definimos los timestamps en la tabla
    public $timestamps = false;


    ## REFERENCIA A OTRAS TABLAS (http://laravel.com/docs/eloquent#relationships)
    public function carrera(){
        // 'esta Asignatura, pertenece a UNA Carrera
        return $this->belongsTo('Carrera', 'codigo_carrera');
    }
}
