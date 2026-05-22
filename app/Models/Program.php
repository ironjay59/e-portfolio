<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'degree_level',
        'duration_years',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duration_years' => 'integer',
    ];

    // Relationships
    public function curricula()
    {
        return $this->hasMany(Curriculum::class);
    }

    public function courses()
    {
        return $this->hasManyThrough(Course::class, Curriculum::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function studentOutcomes()
    {
        return $this->hasMany(StudentOutcome::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
