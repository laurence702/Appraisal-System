<?php

namespace App\Models\Model\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyEvaluationMark extends Model
{
    use HasFactory;
    protected $table = "monthly_evaluation_marks";
    protected $fillable = ['employee_id','hr_id','month_of_evaluation','manager_comment','hr_comment','isEmployeeAccept','isHrAccept','total_mark'];
}
