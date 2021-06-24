<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyEvaluationMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('monthly_evaluation_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->nullable();
            $table->integer('hr_id')->nullable();
            $table->date('month_of_evaluation')->nullable();
            $table->text('manager_comment')->nullable();
            $table->text('hr_comment')->nullable();
            $table->boolean('isEmployeeAccept')->default(0);
            $table->boolean('isHrAccept')->default(0);
            $table->double('total_mark')->nullable();
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
        Schema::dropIfExists('monthly_evaluation_marks');
    }
}
