<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_last',
        'name_first',
        'name_company',
        'email',
        'password',
        'contact_number',
        'address',
        'photo_url',
        'legal_id_photo_url',
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
        ];
    }

    public function contracts(): HasMany {
        return $this->hasMany(Contract::class); // contracts for the tenant
    }

    public function properties(): HasMany {
        return $this->hasMany(Property::class); // properties for the landlords
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class); // payments received by staff
    }

    public function fullName() {
        if(!empty($this->name_company) || $this->name_company != null)
            return $this->name_company;
        return $this->name_first . ' ' . $this->name_last;
    }
}
