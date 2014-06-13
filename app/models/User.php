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

}
