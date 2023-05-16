<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keg', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organization');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch_detail');

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');


            $table->unsignedBigInteger('beer_type_id');
            $table->foreign('beer_type_id')->references('id')->on('beer_type');

            $table->string('pin_keg', 255)->nullable();

            $table->string('name', 100)->nullable();

            $table->dateTime('inbound_datetime')->nullable();
            $table->dateTime('outbound_datetime')->nullable();
            $table->string('outbound_name')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('volume_available')->nullable();
            $table->enum('status', ['Full', 'Empty', 'Half'])->default('Full');
            $table->decimal('capacity')->nullable();

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
        Schema::dropIfExists('keg');
    }
}
