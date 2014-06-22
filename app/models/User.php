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
}
