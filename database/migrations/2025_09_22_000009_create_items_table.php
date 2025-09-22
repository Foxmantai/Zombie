<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name')->nullable();
            $table->string('spawn_name')->nullable();
            $table->string('gewicht')->nullable();
            $table->boolean('seltenes_item')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
