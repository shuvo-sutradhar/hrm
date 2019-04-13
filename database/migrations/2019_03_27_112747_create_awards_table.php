<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('employee_id')->unsigned()->index()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');

            $table->bigInteger('award_type_id')->unsigned()->index()->nullable();
            $table->foreign('award_type_id')->references('id')->on('award_types')->onDelete('cascade')->onUpdate('no action');
            
            $table->string('gift')->nullable();
            $table->string('amount')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('award_img')->nullable();
            $table->text('description')->nullable();
            
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
        Schema::dropIfExists('awards');
    }
}
