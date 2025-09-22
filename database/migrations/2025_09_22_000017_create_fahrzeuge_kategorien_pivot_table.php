<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFahrzeugeKategorienPivotTable extends Migration
{
    public function up()
    {
        Schema::create('fahrzeuge_kategorien', function (Blueprint $table) {
            $table->unsignedBigInteger('fahrzeuge_id');
            $table->foreign('fahrzeuge_id', 'fahrzeuge_id_fk_10722505')->references('id')->on('fahrzeuges')->onDelete('cascade');
            $table->unsignedBigInteger('kategorien_id');
            $table->foreign('kategorien_id', 'kategorien_id_fk_10722505')->references('id')->on('kategoriens')->onDelete('cascade');
        });
    }
}
