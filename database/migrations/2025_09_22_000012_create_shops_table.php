<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shop_name')->nullable();
            $table->string('item_name')->nullable();
            $table->string('preis')->nullable();
            $table->boolean('verkaufbar')->default(0)->nullable();
            $table->string('verkaufs_preis')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
