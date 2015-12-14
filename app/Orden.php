<?php

namespace App;
use Crypt;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Models\SleepingOwlModel;
use Storage;

class Orden extends SleepingOwlModel
{
    protected $table = 'ordenes';

    protected $fillable =[
    	'numero_de_orden',
    	'imprenta_id',
    	'valido_hasta',
    	'comentarios',
    	'archivos',
    ];

   	public function imprenta(){
   		return $this->belongsTo('App\Imprenta');
   	}

   	public function getDates()
	{
	    return array_merge(parent::getDates(), ['valido_hasta']);
	}

	public function getCodigoAttribute(){
		return Crypt::encrypt($this->imprenta_id.";".$this->numero_de_orden);
	}

	public function getListaArchivosAttribute(){
		$carpetas = explode(",",substr($this->archivos,0,strlen($this->archivos)-1));
    $archivos = [];
    foreach($carpetas as $carpeta){
      $archivos_carpeta = Storage::files('archivos-imprentas/'.$carpeta);
      $a = array_merge($archivos,$archivos_carpeta);
      $archivos = $a;
    }

    return $archivos;
	}
}
