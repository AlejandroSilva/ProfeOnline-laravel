<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	// The database table used by the model.
	protected $table = 'usuario';

    // el primary key utilizado en la tabla
    protected $primaryKey = 'codigo_usuario';

    // indicamos que no definimos los timestamps en la tabla
    public $timestamps = false;

    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function esAdministrador(){
        $tipo_usuario = $this->attributes['codigo_tipo_usuario'];
        return $tipo_usuario==1;
    }

    public function esDocente(){
        $tipo_usuario = $this->attributes['codigo_tipo_usuario'];
        return $tipo_usuario==2;
    }
    public function esAlumno(){
        $tipo_usuario = $this->attributes['codigo_tipo_usuario'];
        return $tipo_usuario==3;
    }


    // retorna TRUE o FALSE dependiendo si este usuario se encuentra suscrito a una Asignatura
    public function estaSuscritoA($codigo_asignatura){
        $suscripcion = Suscripcion::
              where('codigo_usuario', '=', $this->attributes['codigo_usuario'])
            ->where('codigo_asignatura', '=', $codigo_asignatura)
            ->first();
        return $suscripcion!=null;
    }

    // entrega una relacion con la tabla suscripciones
    public function suscripciones(){
        return $this->hasMany('Suscripcion', 'codigo_usuario', 'codigo_usuario');
    }
    // entrega una relacion con la tabla suscripcionesm, filtrando solo las de tipo 1 (Creador)
    public function suscripcionesTipo1(){
        return $this->hasMany('Suscripcion', 'codigo_usuario', 'codigo_usuario')->where('codigo_tipo_suscripcion', '=', '1');
    }

    public function asignaturasSuscritas(){
        // obtenemos las suscripciones relacionadas a este usuario
        $suscripciones = $this->suscripciones;

        // creamos un nuevo arreglo
        $asignaturas = array();
        // agregamos cada asignatura que este asociada a las suscripciones
        foreach( $suscripciones as $sus )
            array_push($asignaturas, $sus->asignatura);
        // entregamos el listado de asignaturas
        return $asignaturas;
    }

    public function asignaturasCreadas(){
        // obtenemos las suscripciones relacionadas a este usuario
        $suscripciones = $this->suscripcionesTipo1;

        // creamos un nuevo arreglo
        $asignaturas = array();
        // agregamos cada asignatura que este asociada a las suscripciones
        foreach( $suscripciones as $sus )
            array_push($asignaturas, $sus->asignatura);
        // entregamos el listado de asignaturas
        return $asignaturas;
    }
}
