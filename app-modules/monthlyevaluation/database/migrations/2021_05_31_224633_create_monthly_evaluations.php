<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->text('key_result_area')->nullable();
            $table->date('month_of_evaluation')->nullable();
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
        Schema::dropIfExists('monthly_evaluations');
    }
}
