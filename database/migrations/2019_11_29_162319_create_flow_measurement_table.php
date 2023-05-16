<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowMeasurementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_measurement', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organization');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch_detail');
            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('device');
            $table->unsignedBigInteger('sensor_id');
            $table->foreign('sensor_id')->references('id')->on('sensor');

            $table->integer('tap_id');
            $table->integer('keg_id');
            $table->decimal('pulse', 7,2);
            $table->integer('mililiters');
            $table->tinyInteger('power_supply');

            $table->dateTime('started_at');
            $table->dateTime('finished_at');

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
        Schema::dropIfExists('flow_measurement');
    }
}
