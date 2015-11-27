<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_de_orden')->unique();
            $table->integer('imprenta_id')->unsigned();
            $table->date('valido_hasta');
            $table->longText('archivos');
            $table->timestamps();
            $table->foreign('imprenta_id')->references('id')->on('imprentas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ordenes');
    }
}
