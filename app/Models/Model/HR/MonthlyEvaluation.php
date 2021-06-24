<?php

namespace App\Models\Model\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyEvaluation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','employee_id','key_result_area','month_of_evaluation'];
}
