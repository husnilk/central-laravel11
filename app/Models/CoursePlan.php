<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoursePlan extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'validated_at' => 'timestamp',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function validatedBy(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function coursePlanRequirements(): HasMany
    {
        return $this->hasMany(CoursePlanRequirement::class);
    }

    public function coursePlanReferences(): HasMany
    {
        return $this->hasMany(CoursePlanReference::class);
    }

    public function coursePlanMaterials(): HasMany
    {
        return $this->hasMany(CoursePlanMaterial::class);
    }

    public function coursePlanDetails(): HasMany
    {
        return $this->hasMany(CoursePlanDetail::class);
    }

    public function coursePlanAssessments(): HasMany
    {
        return $this->hasMany(CoursePlanAssessment::class);
    }

    public function coursePlanLecturers(): HasMany
    {
        return $this->hasMany(CoursePlanLecturers::class);
    }

    public function coursePlanLos(): HasMany
    {
        return $this->hasMany(CoursePlanLo::class);
    }

    public function coursePlanMedia(): HasMany
    {
        return $this->hasMany(CoursePlanMedia::class);
    }

    public function classCourses(): HasMany
    {
        return $this->hasMany(ClassCourse::class);
    }
}
