<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurriculumPeoPlo extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function curriculumPeo(): BelongsTo
    {
        return $this->belongsTo(CurriculumPeo::class);
    }

    public function curriculumPlo(): BelongsTo
    {
        return $this->belongsTo(CurriculumPlo::class);
    }
}
