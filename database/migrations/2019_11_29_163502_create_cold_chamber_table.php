<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdChamberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_chamber', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', 100);
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organization');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch_detail');

            $table->unsignedBigInteger('sensor_id')->nullable();
            $table->foreign('sensor_id')->references('id')->on('sensor');

            $table->enum('status', ['Ativo', 'Inativo']);
            $table->integer('capacity');

            $table->string('slug', 100);
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
        Schema::dropIfExists('cold_chamber');
    }
}
