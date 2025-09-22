<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorienWerkbankePivotTable extends Migration
{
    public function up()
    {
        Schema::create('kategorien_werkbanke', function (Blueprint $table) {
            $table->unsignedBigInteger('werkbanke_id');
            $table->foreign('werkbanke_id', 'werkbanke_id_fk_10722569')->references('id')->on('werkbankes')->onDelete('cascade');
            $table->unsignedBigInteger('kategorien_id');
            $table->foreign('kategorien_id', 'kategorien_id_fk_10722569')->references('id')->on('kategoriens')->onDelete('cascade');
        });
    }
}
