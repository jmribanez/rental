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

    public function activeContract() {
        return $this->contracts->where('date_start','<=',date("Y-m-d"))->where('date_end','>=',date("Y-m-d"))->first();
    }

    public function lastContract() {
        $lastStart = date("Y-m-d");
        if($this->activeContract() != null) {
            $lastStart = $this->activeContract()->date_start;
        }
        return $this->contracts->where('date_end','<',$lastStart)->first();
    }

    public function lastPayment() {
        // if($this->payments->count() == 0)
        //     return null;
        // return $this->payments->sortByDesc('date_payment')->first();
        $lastPayment = (object)['date_payment' => '2000-01-01'];
        foreach($this->contracts as $c) {
            if($c->lastPayment()->date_payment > $lastPayment->date_payment)
                $lastPayment = $c->lastPayment();
        }
        if($lastPayment->date_payment == '2000-01-01')
            return null;
        else
            return $lastPayment;
    }

    public function getBalance() {
        $balance = 0;
        $contracts = $this->contracts;
        foreach($contracts as $c) {
            $balance += $c->getBalanceRaw();
        }
        return number_format($balance,2);
    }

    public function getBalanceRaw() {
        $balance = 0;
        $contracts = $this->contracts;
        foreach($contracts as $c) {
            $balance += $c->getBalanceRaw();
        }
        return $balance;
    }
}
