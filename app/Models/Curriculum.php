<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curriculum extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function peos(): HasMany
    {
        return $this->hasMany(CurriculumPeo::class);
    }

    public function plos(): HasMany
    {
        return $this->hasMany(CurriculumPlo::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function boks(): HasMany
    {
        return $this->hasMany(CurriculumBok::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
