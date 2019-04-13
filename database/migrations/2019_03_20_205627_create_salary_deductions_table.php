<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('policyName')->unique();
            $table->string('deductionForm');
            $table->integer('deductionAfter');
            $table->integer('deductionRate');
            $table->text('deductionComment')->nullable();
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
        Schema::dropIfExists('salary_deductions');
    }
}
