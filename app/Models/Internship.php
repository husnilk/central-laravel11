<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Internship extends Model
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
        'start_at' => 'date',
        'end_at' => 'date',
        'seminar_date' => 'date',
        'seminar_deadline' => 'date',
        'lecturer_id' => 'integer',
    ];

    public function internshipProposal(): BelongsTo
    {
        return $this->belongsTo(InternshipProposal::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function advisor(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function seminarRoom(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function internshipLogbooks(): HasMany
    {
        return $this->hasMany(InternshipLogbook::class);
    }

    public function internshipSeminarAudiences(): HasMany
    {
        return $this->hasMany(InternshipSeminarAudience::class);
    }
}
