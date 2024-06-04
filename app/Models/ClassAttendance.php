<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassAttendance extends Model
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
        'latitude' => 'double',
        'longitude' => 'double',
        'rating' => 'double',
    ];

    public function courseEnrollmentDetail(): BelongsTo
    {
        return $this->belongsTo(CourseEnrollmentDetail::class);
    }

    public function classMeeting(): BelongsTo
    {
        return $this->belongsTo(ClassMeeting::class);
    }
}
