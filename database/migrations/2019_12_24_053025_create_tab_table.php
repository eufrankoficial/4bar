<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tap', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organization');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch_detail');

            $table->unsignedBigInteger('keg_id')->nullable();
            $table->foreign('keg_id')->references('id')->on('keg');

            $table->unsignedBigInteger('sensor_id')->nullable();
            $table->foreign('sensor_id')->references('id')->on('sensor');

            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
            $table->string('name', 255);
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
        Schema::dropIfExists('tap');
    }
}
