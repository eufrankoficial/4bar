<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beer_type', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organization');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch_detail');

            $table->string('name', 100);
            $table->enum('status', ['Approved', 'Pending']);
            $table->string('ibu', 100);
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
        Schema::dropIfExists('beer_type');
    }
}
