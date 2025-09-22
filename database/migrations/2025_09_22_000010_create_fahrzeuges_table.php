<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFahrzeugesTable extends Migration
{
    public function up()
    {
        Schema::create('fahrzeuges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fahrzeug_name')->nullable();
            $table->string('spawn_name')->nullable();
            $table->string('preis')->nullable();
            $table->string('kofferraum_groesse')->nullable();
            $table->boolean('herstellbar')->default(0)->nullable();
            $table->boolean('im_shop')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
