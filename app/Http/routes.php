<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Orden;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orden',function(){
	$codigo = Input::get('codigo');
	if($codigo == ''){
		abort(404);
	}
	try {
		$vars = Crypt::decrypt($codigo);
	} catch (DecryptException $e) {
    	abort(404);
	}

	$variables = explode(";", $vars);

	$orden = Orden::whereDate('valido_hasta','>=',date('Y-m-d'))->where("imprenta_id","=",$variables[0])->where("numero_de_orden",'=',$variables[1])->firstOrFail();
	return view('orden',["orden"=>$orden]);

});
Route::get('/archivo',function(){
	$codigo = Input::get('codigo');
	if($codigo == ''){
		abort(404);
	}
	$idx = Input::get('idx');
	if($idx == ''){
		abort(404);
	}

	try {
		$vars = Crypt::decrypt($codigo);
	} catch (DecryptException $e) {
    	abort(404);
	}

	$variables = explode(";", $vars);
	$orden = Orden::whereDate('valido_hasta','>=',date('Y-m-d'))->where("imprenta_id","=",$variables[0])->where("numero_de_orden",'=',$variables[1])->firstOrFail();
	
	$archivos = $orden->lista_archivos;


	$mimetype = array( 
                'gif'=>'image/gif', 
                'png'=>'image/png', 
                'jpg'=>'image/jpeg', 
                'cdr'=>'image/x-coreldraw',
                'psd'=>'image/x-photoshop',
                'pdf'=>'application/pdf',
                '.ai'=>'application/illustrator',
                'zip'=>'application/zip',
                ); 
    $content = NULL;
    $mime = NULL;
    if (Storage::has($archivos[$idx])){
        $content = Storage::get($archivos[$idx]);
        $mime = $mimetype[substr($archivos[$idx],-3)];
    }
	if($content == NULL){
        abort(404);
    }

    return response($content)->header('Content-Type', $mime)->header('Content-Disposition', 'attachment;filename='.$archivos[$idx]);

});
