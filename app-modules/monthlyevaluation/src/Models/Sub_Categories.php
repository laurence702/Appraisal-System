<?php

namespace Modules\Monthlyevaluation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sub_Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'monthly_evaluation_categories';

    protected $fillable = ['monthly_evaluation_id', 'task'];

    
    /**
     * Get the evaluation that owns the Sub_Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(MonthlyEvaluation::class);
    }
    
}
