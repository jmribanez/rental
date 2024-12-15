<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    Use SoftDeletes;
    // Note (12/15) - formerly Transaction
    protected $fillable = ['date_payment', 'contract_id', 'amount', 'or_number', 'date_paid_start', 'date_paid_end'];

    public function contract(): BelongsTo {
        return $this->belongsTo(Contract::class);
    }
}
