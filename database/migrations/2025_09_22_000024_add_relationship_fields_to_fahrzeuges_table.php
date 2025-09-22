<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFahrzeugesTable extends Migration
{
    public function up()
    {
        Schema::table('fahrzeuges', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_10722484')->references('id')->on('teams');
        });
    }
}
