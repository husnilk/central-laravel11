<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassProblem extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function classCourse(): BelongsTo
    {
        return $this->belongsTo(ClassCourse::class);
    }

    public function courseEnrollmentDetail(): BelongsTo
    {
        return $this->belongsTo(CourseEnrollmentDetail::class);
    }
}
