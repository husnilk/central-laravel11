<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThesisRubric extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function thesisRubricDetails(): HasMany
    {
        return $this->hasMany(ThesisRubricDetail::class);
    }

    public function thesisTrials(): HasMany
    {
        return $this->hasMany(ThesisTrial::class);
    }
}
