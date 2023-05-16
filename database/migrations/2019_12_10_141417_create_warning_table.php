<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warning', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organization');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch_detail');

            $table->unsignedBigInteger('keg_id')->nullable();
            $table->foreign('keg_id')->references('id')->on('keg');

            $table->unsignedBigInteger('cold_chamber_id')->nullable();
            $table->foreign('cold_chamber_id')->references('id')->on('cold_chamber');

            $table->string('name', 255);

            $table->enum('type', ['Camara Fria', 'Barril']);

            $table->float('value_from')->nullable();
            $table->float('value_to')->nullable();

            $table->string('slug', 255);

            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warning');
    }
}
