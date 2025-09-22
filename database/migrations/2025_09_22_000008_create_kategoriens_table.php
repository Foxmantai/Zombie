<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriensTable extends Migration
{
    public function up()
    {
        Schema::create('kategoriens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kategorie')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
