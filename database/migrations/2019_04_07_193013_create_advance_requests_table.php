<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advance_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('employee_id')->unsigned()->index()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');

            $table->string('apply_date')->nullable();

            $table->integer('request_amount')->nullable();

            $table->string('month')->nullable();

            $table->integer('year')->nullable();

            $table->integer('status')->nullable();

            $table->text('comment')->nullable();

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
        Schema::dropIfExists('advance_requests');
    }
}
