<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasPermissions, HasRoles, HasUuids, Notifiable;

    const STUDENT = 1;

    const LECTURER = 2;

    const STAFF = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'integer',
            'type' => 'integer',
        ];
    }

    public function civitas(): HasOne
    {
        switch ($this->type) {
            case self::STUDENT:
                return $this->student();
            case self::LECTURER:
                return $this->lecturer();
            case self::STAFF:
                return $this->staff();
        }

        return null;
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id');
    }

    public function lecturer(): HasOne
    {
        return $this->hasOne(Lecturer::class, 'id');
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'id');
    }

    public function logins(): HasMany
    {
        return $this->hasMany(UserLogin::class);
    }
}
