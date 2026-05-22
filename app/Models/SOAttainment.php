<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SOAttainment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'so_attainments';

    protected $fillable = [
        'student_outcome_id',
        'performance_indicator_id',
        'attainment_percentage',
        'total_attempts',
        'successful_attempts',
    ];

    protected $casts = [
        'attainment_percentage' => 'decimal:2',
    ];

    // Relationships
    public function studentOutcome()
    {
        return $this->belongsTo(StudentOutcome::class);
    }

    public function performanceIndicator()
    {
        return $this->belongsTo(PerformanceIndicator::class);
    }
}
