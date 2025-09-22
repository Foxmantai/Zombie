<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToItemsTable extends Migration
{
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('kategorie_id')->nullable();
            $table->foreign('kategorie_id', 'kategorie_fk_10722472')->references('id')->on('kategoriens');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_10722476')->references('id')->on('teams');
        });
    }
}
