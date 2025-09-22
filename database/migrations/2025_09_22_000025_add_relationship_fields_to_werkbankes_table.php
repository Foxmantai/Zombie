<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWerkbankesTable extends Migration
{
    public function up()
    {
        Schema::table('werkbankes', function (Blueprint $table) {
            $table->unsignedBigInteger('endergebnis_id')->nullable();
            $table->foreign('endergebnis_id', 'endergebnis_fk_10722565')->references('id')->on('items');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_10722511')->references('id')->on('teams');
        });
    }
}
