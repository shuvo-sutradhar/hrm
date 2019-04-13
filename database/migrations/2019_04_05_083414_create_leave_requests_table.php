<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('apply_date')->nullable();

            $table->integer('employee_id')->unsigned()->index()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');

            $table->integer('leave_id')->unsigned()->nullable();
            $table->foreign('leave_id')->references('id')->on('leaves')->onDelete('cascade')->onUpdate('no action');

            $table->integer('duration')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('hours')->nullable();
            $table->text('reason')->nullable();
            $table->string('attachment')->nullable();
            $table->string('status')->nullable();
            
            $table->integer('status_change_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
}
