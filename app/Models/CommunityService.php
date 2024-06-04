<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommunityService extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function communityServiceSchema(): BelongsTo
    {
        return $this->belongsTo(CommunityServiceSchema::class);
    }

    public function communityServiceMembers(): HasMany
    {
        return $this->hasMany(CommunityServiceMember::class);
    }
}
