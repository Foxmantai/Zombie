<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titel');
            $table->string('ingame_name');
            $table->longText('grund');
            $table->string('supporter')->nullable();
            $table->string('status')->nullable();
            $table->string('kategorie');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
