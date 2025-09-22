<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTebexLizenzensTable extends Migration
{
    public function up()
    {
        Schema::table('tebex_lizenzens', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_10722408')->references('id')->on('teams');
        });
    }
}
