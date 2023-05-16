<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemperatureMeasurementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temperature_measurement', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organization');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch_detail');

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('device');

            $table->unsignedBigInteger('sensor_id');
            $table->foreign('sensor_id')->references('id')->on('sensor');

            $table->unsignedBigInteger('cold_chamber_id');
            $table->foreign('cold_chamber_id')->references('id')->on('cold_chamber');


            $table->decimal('temperature', 4,2);
            $table->tinyInteger('power_supply'); // -- 1 = Battery and 2 = Network

            $table->dateTime('measured_at');

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
        Schema::dropIfExists('temperature_measurement');
    }
}
