<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThesisDefenseExaminer extends Model
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
        'lecturer_id' => 'integer',
    ];

    public function thesisDefense(): BelongsTo
    {
        return $this->belongsTo(ThesisDefense::class);
    }

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function examiner(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function thesisDefenseScores(): HasMany
    {
        return $this->hasMany(ThesisDefenseScore::class);
    }
}
