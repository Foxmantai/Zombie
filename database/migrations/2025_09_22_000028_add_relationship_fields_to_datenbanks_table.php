<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDatenbanksTable extends Migration
{
    public function up()
    {
        Schema::table('datenbanks', function (Blueprint $table) {
            $table->unsignedBigInteger('kategorie_id')->nullable();
            $table->foreign('kategorie_id', 'kategorie_fk_10722816')->references('id')->on('kategoriens');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_10722820')->references('id')->on('teams');
        });
    }
}
