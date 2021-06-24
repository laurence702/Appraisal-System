<?php

namespace Modules\Monthlyevaluation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ME_Marks extends Model
{
    use HasFactory;
    protected $table='monthly_evaluation_marks';

    /**
     * Get the user that owns the ME_Marks
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function appraisal(): BelongsTo
    {
        return $this->belongsTo(Monthlyevaluation::class, 'month_of_evaluation');
    }
}
