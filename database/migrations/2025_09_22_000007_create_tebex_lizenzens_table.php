<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTebexLizenzensTable extends Migration
{
    public function up()
    {
        Schema::create('tebex_lizenzens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('haendler')->nullable();
            $table->date('gekauft_am')->nullable();
            $table->string('tebexid')->nullable();
            $table->string('preis')->nullable();
            $table->string('url')->nullable();
            $table->longText('produkt')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
