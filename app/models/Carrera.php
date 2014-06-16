<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Carrera extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    // The database table used by the model.
    protected $table = 'carrera';

    // el primary key utilizado en la tabla
    protected $primaryKey = 'codigo_carrera';

    // indicamos que no definimos los timestamps en la tabla
    public $timestamps = false;


    ## REFERENCIA A OTRAS TABLAS (http://laravel.com/docs/eloquent#relationships)
    public function sede(){
        // 'esta Carrera, pertenece a UNA Sede'
        return $this->belongsTo('Sede', 'codigo_sede');
    }
}
