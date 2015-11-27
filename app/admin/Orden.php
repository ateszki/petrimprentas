<?php
//dd(Storage::files('archivos-imprentas'));
Admin::model(\App\Orden::class)->title('Ordenes')->with()->filters(function ()
{

})->columns(function ()
{
	Column::string('numero_de_orden', 'Numero de orden');
	Column::date('valido_hasta', 'Valido Hasta')->format('medium', 'none');
	Column::string('imprenta.nombre', 'Imprenta');
	Column::Link('codigo', 'URL')->sortable(false);
	Column::action('email', 'email')->icon('fa-envelope-o')->style('short')->callback(function ($instance)
		{
			$imprenta = $instance->imprenta;
		    Mail::send('email', ['imprenta' => $imprenta, 'orden'=> $instance], function ($m) use ($instance,$imprenta) {
            $m->from('muriell@petrilac.com.ar', 'Muriel Lodeiro');

            $m->to($imprenta->email, $imprenta->contacto)->subject('Archivos disponibles para orden de compra: '.$instance->numero_de_orden);
        	});

		    //return Redirect::route('my-route', [$instance->id]);
		});
})->form(function ()
{
	FormItem::text('numero_de_orden', 'Numero De Orden');
	FormItem::select('imprenta_id', 'Imprenta')->list(App\Imprenta::class);
	FormItem::date('valido_hasta', 'Valido Hasta');
	FormItem::textarea('comentarios','Comentarios');
	FormItem::archivosSelector('archivos_s', 'Archivos');
	FormItem::archivosHidden('archivos','');
});