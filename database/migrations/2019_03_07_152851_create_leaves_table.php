<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leave_policy_id')->unsigned()->nullable();
            $table->string('leaveName');
            $table->integer('leaveNumber')->default(10);
            $table->integer('payFor')->nullable()->default(0);
            $table->integer('isApprove')->nullable()->default(0);
            $table->string('color')->nullable()->default('0665D0');
            $table->timestamps();
            $table->foreign('leave_policy_id')->references('id')->on('leave_policies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
