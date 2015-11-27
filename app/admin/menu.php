<?php

/*
 * Describe your menu here.
 *
 * There is some simple examples what you can use:
 *
 * 		Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard')->uses('\AdminController@getIndex');
 * 		Admin::menu(User::class)->icon('fa-user');
 * 		Admin::menu()->label('Menu with subitems')->icon('fa-book')->items(function ()
 * 		{
 * 			Admin::menu(\Foo\Bar::class)->icon('fa-sitemap');
 * 			Admin::menu('\Foo\Baz')->label('Overwrite model title');
 * 			Admin::menu()->url('my-page')->label('My custom page')->uses('\MyController@getMyPage');
 * 		});
 */
AdminRouter::get('/', function ()
{
    return redirect('admin/ordens');
});
//Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard')->uses('\SleepingOwl\Admin\Controllers\DummyController@getIndex');
Admin::menu(App\Imprenta::class)->icon('fa-stack-overflow');
Admin::menu(App\Orden::class)->icon('fa-file-text-o');
