<?php

Admin::model(\App\Imprenta::class)->title('Imprentas')->with()->filters(function ()
{

})->columns(function ()
{
	Column::string('nombre', 'Nombre');
	Column::string('contacto', 'Contacto');
	Column::string('email', 'Email');
})->form(function ()
{
	FormItem::text('nombre', 'Nombre');
	FormItem::text('contacto', 'Contacto');
	FormItem::text('email', 'Email');
});

