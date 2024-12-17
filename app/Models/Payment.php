<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    Use SoftDeletes;
    // Note (12/15) - formerly Transaction
    protected $fillable = ['date_payment', 'contract_id', 'user_id', 'amount', 'or_number', 'date_coverage_start', 'date_coverage_end', 'notes'];

    public function contract(): BelongsTo {
        return $this->belongsTo(Contract::class);
    }

    public function receiver(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDatePayment() {
        return date('M j, Y',strtotime($this->date_payment));
    }

    public function getCoverageDate() {
        return date('F j, Y',strtotime($this->date_coverage_start)) . ' to ' . date('F j, Y',strtotime($this->date_coverage_end));
    }

    public function amountToString() {
        return number_format($this->amount,2);
    }
}
