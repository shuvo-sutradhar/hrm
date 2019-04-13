<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('employee_id')->unsigned()->index()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');

            $table->string('apply_date')->nullable();

            $table->integer('request_amount')->nullable();

            $table->integer('installment_per_month')->nullable();

            $table->timestamp('start_installment_date')->nullable();

            $table->timestamp('last_installment_date')->nullable();

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
        Schema::dropIfExists('loan_requests');
    }
}
