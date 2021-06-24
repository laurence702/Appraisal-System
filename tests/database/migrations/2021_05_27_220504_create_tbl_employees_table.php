<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_code', 20)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('branch', 100)->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('username', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->integer('gender');
            $table->integer('marital_status')->nullable();
            $table->string('national_id')->nullable();
            $table->string('nationality', 199)->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanant_address')->nullable();
            $table->string('mobile_no', 20)->nullable();
            $table->string('phone_no', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('leaving_date')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('shift_id')->nullable();
            $table->integer('employee_type')->nullable();
            $table->integer('role');
            $table->tinyInteger('allowed_leaves')->nullable();
            $table->integer('salary_type')->nullable();
            $table->double('monthly_reimbursable')->nullable();
            $table->double('monthly_salary')->nullable();
            $table->double('basic_salary')->nullable();
            $table->double('accomodation_allowance')->nullable();
            $table->double('gross')->nullable();
            $table->double('percentage_to_achived')->nullable();
            $table->double('house_rent_allowance')->nullable();
            $table->double('transportation_allowance')->nullable();
            $table->double('telephone_allowance')->nullable();
            $table->double('leave_allowance')->nullable();
            $table->double('others_allowance')->nullable();
            $table->string('monthly_target', 50)->nullable();
            $table->string('smartsaver_date', 50)->nullable();
            $table->integer('smartsaver_percentage')->default(10);
            $table->string('account_number', 50)->nullable();
            $table->string('beneficiary_bank', 100)->nullable();
            $table->double('overtime_1')->nullable();
            $table->double('overtime_2')->nullable();
            $table->double('overtime_3')->nullable();
            $table->tinyInteger('status');
            $table->string('confirm_status', 20)->nullable();
            $table->string('confirmed_by', 11)->nullable();
            $table->string('avatar')->nullable();
            $table->string('other_documents')->nullable();
            $table->string('cover')->nullable();
            $table->text('reference')->nullable();
            $table->rememberToken();
            $table->integer('create_by');
            $table->integer('updated_by')->nullable();
            $table->string('date_updated', 30)->nullable();
            $table->string('create_ip', 45)->nullable();
            $table->string('login_ip', 45)->nullable();
            $table->dateTime('last_login_time')->nullable();
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
        Schema::dropIfExists('tbl_employees');
    }
}
