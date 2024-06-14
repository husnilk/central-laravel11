<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassMeeting extends Model
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
        'meeting_start_at' => 'timestamp',
        'meeting_end_at' => 'timestamp',
        'class_course_id' => 'integer',
        'lecturer_id' => 'integer',
    ];

    public function classcourse(): BelongsTo
    {
        return $this->belongsTo(ClassCourse::class);
    }

    public function detail(): BelongsTo
    {
        return $this->belongsTo(CoursePlanDetail::class, 'course_plan_detail_id', 'id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(ClassAttendance::class);
    }
}
