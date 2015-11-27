<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Models\SleepingOwlModel;

class Imprenta extends SleepingOwlModel
{
	protected $fillable = [
		'nombre',
		'contacto',
		'email',
	];

    public function ordenes(){
    	return $this->hasMany('App\Orden');
    }

    public static function getList(){
    	return static::lists('nombre', 'id')->all();
    }
}
