<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','type','address_street','address_city','photo_url','bedrooms','bathrooms','floor_area','land_size','user_id','amount_rental'];

    // function landlords (BelongsToMany) via Property_User table
    // change the landlords to BelongsTo one

    public function landlord(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function utilities(): BelongsToMany {
        return $this->belongsToMany(Utility::class)->withPivot('account_number');
    }

    public function contracts(): HasMany {
        return $this->hasMany(Contract::class);
    }

    public function activeContract() {
        return $this->contracts->where('date_start','<=',date("Y-m-d"))->where('date_end','>=',date("Y-m-d"))->first();
    }

    public function lastContract() {
        if($this->contracts->count() == 0)
            return null;
        return $this->contracts->sortByDesc('date_end')->first();
    }

    public function amountrentalToString() {
        return number_format($this->amount_rental,2);
    }

    public function getPayments() {
        $payments = array();
        foreach($this->contracts as $c) {
            foreach($c->payments as $p) {
                array_push($payments, $p);
            }
        }
        return $payments;
    }
}
