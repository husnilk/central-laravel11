<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoursePlanDetail extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function coursePlanDetailActivities(): HasMany
    {
        return $this->hasMany(CoursePlanDetailActivity::class);
    }

    public function classMeetings(): HasMany
    {
        return $this->hasMany(ClassMeeting::class);
    }

    public function coursePlan(): BelongsTo
    {
        return $this->belongsTo(CoursePlan::class);
    }

    public function coursePlanLo(): BelongsTo
    {
        return $this->belongsTo(CoursePlanLo::class);
    }
}
