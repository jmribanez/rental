<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['property_id','user_id','date_contract','date_start','date_end','amount_security_deposit',
                            'amount_rental', 'agreed_payment_mode', 'scanned_contract_file',];

    public function property(): BelongsTo {
        return $this->belongsTo(Property::class);
    }

    public function tenant(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class); // payments made for property rentals through contracts
    }

    public function contractDateToString() {
        return date('F j, Y',strtotime($this->date_start)) . ' to ' . date('F j, Y',strtotime($this->date_end));
    }

    public function contractMidDateToString() {
        return date('M j, Y',strtotime($this->date_start)) . ' - ' . date('M j, Y',strtotime($this->date_end));
    }

    public function amountrentalToString() {
        return number_format($this->amount_rental,2);
    }

    public function lastPayment() {
        if($this->payments->count() == 0)
            return null;
        return $this->payments->sortByDesc('date_payment')->first();
    }

    public function getBalance() {
        $date_end = min(date_create($this->date_end), date_create(date("Y-m-d")));
        $months_passed = date_diff(date_create($this->date_start), $date_end);
        $balance = ($this->amount_rental * ((int)$months_passed->format("%m")+1)) - $this->payments->sum("amount");
        return number_format($balance,2);
    }

    public function getBalanceRaw() {
        $date_end = min(date_create($this->date_end), date_create(date("Y-m-d")));
        $months_passed = date_diff(date_create($this->date_start), $date_end);
        $balance = ($this->amount_rental * ((int)$months_passed->format("%m")+1)) - $this->payments->sum("amount");
        return $balance;
    }

    public function getMonthsDue() {
        $date_end = min(date_create($this->date_end), date_create(date("Y-m-d")));
        $months_passed = date_diff(date_create($this->date_start), $date_end);
        $balance = ($this->amount_rental * ((int)$months_passed->format("%m")+1)) - $this->payments->sum("amount");
        return (int)$balance / $this->amount_rental;
    }
}
