<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationanddepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_departments', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('title', 100)->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tbl_designations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('tbl_departments');
        Schema::dropIfExists('tbl_designations');
    }
}
