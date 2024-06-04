<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThesisDefenseScore extends Model
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
        'score' => 'float',
    ];

    public function thesisDefenseExaminer(): BelongsTo
    {
        return $this->belongsTo(ThesisDefenseExaminer::class);
    }

    public function thesisRubricDetail(): BelongsTo
    {
        return $this->belongsTo(ThesisRubricDetail::class);
    }
}
