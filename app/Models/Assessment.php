<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
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
        'grade' => 'double',
    ];

    public function assessmentDetail(): BelongsTo
    {
        return $this->belongsTo(AssessmentDetail::class);
    }

    public function courseEnrollmentDetail(): BelongsTo
    {
        return $this->belongsTo(CourseEnrollmentDetail::class);
    }
}
