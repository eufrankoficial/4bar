<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinKegBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pin_keg_branch', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organization');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branch_detail');

            $table->char('pin', 6);
            $table->tinyInteger('used')->default(0);
            $table->string('slug');

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
        Schema::dropIfExists('pin_keg_branch');
    }
}
