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

    // todas las suscripciones que tiene esta asignatura
    public function suscripciones(){
        return $this->hasMany('Suscripcion', 'codigo_asignatura', 'codigo_asignatura');
    }

    // retorna una relacion: la suscripcion del creador de la asignatura
    public function suscripcionDocente(){
        return $this->hasOne('Suscripcion', 'codigo_asignatura', 'codigo_asignatura')->where('codigo_tipo_suscripcion', '=', '1');
    }

    public function getDocente(){
        // obtiene la suscripcion del docente
        $suscripcionDocente = $this->suscripcionDocente;
        // entrega el usuario asociado
        return User::where('codigo_usuario', '=', $suscripcionDocente->codigo_usuario)->first();
    }

    // Una Asisgnatura tiene Muchas Publicaciones
    public function publicaciones(){
        return $this->hasMany('Publicacion', 'codigo_asignatura');
    }
    // retorna la o las publicaciones destacadas existentes
    public function publicacionesDestacadas(){
        return $this->publicaciones()->where('destacada', '=', '1');
    }
    // retorna la o las publicaciones "normales" (no destacadas)
    public function publicacionesNormales(){
        return $this->publicaciones()->where('destacada', '=', '0');
    }
}
