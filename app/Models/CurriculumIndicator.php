<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurriculumIndicator extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function coursePlanLos(): HasMany
    {
        return $this->hasMany(CoursePlanLo::class);
    }

    public function courseCurriculumIndicators(): HasMany
    {
        return $this->hasMany(CourseCurriculumIndicator::class);
    }

    public function curriculumPlo(): BelongsTo
    {
        return $this->belongsTo(CurriculumPlo::class);
    }
}
