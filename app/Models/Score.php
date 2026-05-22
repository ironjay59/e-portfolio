<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'artifact_id',
        'rubric_criteria_id',
        'faculty_id',
        'points',
        'feedback',
    ];

    protected $casts = [
        'points' => 'decimal:2',
    ];

    // Relationships
    public function artifact()
    {
        return $this->belongsTo(StudentArtifact::class);
    }

    public function rubricCriteria()
    {
        return $this->belongsTo(RubricCriteria::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
