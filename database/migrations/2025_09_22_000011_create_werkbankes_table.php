<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWerkbankesTable extends Migration
{
    public function up()
    {
        Schema::create('werkbankes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('werkbank')->nullable();
            $table->string('bauteile')->nullable();
            $table->string('xp')->nullable();
            $table->string('lvl')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
