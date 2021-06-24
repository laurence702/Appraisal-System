<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyEvaluationCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_evaluation_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('monthly_evaluation_id')->nullable();
            $table->foreign('monthly_evaluation_id')->references('id')->on('monthly_evaluations')->onUpdate('cascade')->onDelete('cascade');
            $table->text('task')->nullable();
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
        Schema::dropIfExists('monthly_evaluation_categories');
    }
}
