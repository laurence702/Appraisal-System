<?php

namespace Modules\Monthlyevaluation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyEvaluation extends Model //KPI MODEL
{
    use HasFactory, SoftDeletes;

    protected $table = 'monthly_evaluations';

    protected $fillable = ['user_id','employee_id','key_result_area','month_of_evaluation'];
    
    public $timestamps = ['created_at','updated_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'deleted_at' => 'datetime:Y-m-d',
    ];

    protected $hidden = ['deleted_at'];
    /**
     * Get all of the subkpi for the MonthlyEvaluation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkpi(): HasMany
    {
        return $this->hasMany(Sub_Categories::class, 'monthly_evaluation_id');
    }
}

