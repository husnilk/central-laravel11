<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InternshipProposal extends Model
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
        'internship_company_id' => 'integer',
    ];

    public function internshipCompany(): BelongsTo
    {
        return $this->belongsTo(InternshipCompany::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(InternshipCompany::class);
    }

    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class);
    }
}
