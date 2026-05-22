<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerformanceIndicator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_outcome_id',
        'code',
        'description',
        'weight',
        'proficiency_level',
        'is_active',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function studentOutcome()
    {
        return $this->belongsTo(StudentOutcome::class);
    }

    public function courseMappings()
    {
        return $this->hasMany(SOCourseMapping::class);
    }

    public function artifactMappings()
    {
        return $this->hasMany(ArtifactMapping::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
