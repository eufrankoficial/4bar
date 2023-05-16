<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColdChamberIdToKegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keg', function (Blueprint $table) {
            $table->unsignedBigInteger('cold_chamber_id')->nullable();
            $table->foreign('cold_chamber_id')->references('id')->on('cold_chamber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keg', function (Blueprint $table) {
            $table->dropColumn('cold_chamber_id');
        });
    }
}
