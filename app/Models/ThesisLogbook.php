<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThesisLogbook extends Model
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
        'date' => 'date',
        'supervised_at' => 'datetime',
        'thesis_supervisor_id' => 'integer',
    ];

    public function thesis(): BelongsTo
    {
        return $this->belongsTo(Thesis::class);
    }

    public function thesisSupervisor(): BelongsTo
    {
        return $this->belongsTo(ThesisSupervisor::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(ThesisSupervisor::class);
    }

    public function supervisedBy(): BelongsTo
    {
        return $this->belongsTo(ThesisSupervisor::class);
    }
}
