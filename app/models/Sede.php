<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Sede extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    // The database table used by the model.
    protected $table = 'sede';

    // el primary key utilizado en la tabla
    protected $primaryKey = 'codigo_sede';

    // indicamos que no definimos los timestamps en la tabla
    public $timestamps = false;
}
