<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['property_id','user_id','date_contract','date_start','date_end','invoice_day','amount_security_deposit',
                            'amount_rental', 'agreed_payment_mode', 'scanned_contract_file',];

    public function property(): BelongsTo {
        return $this->belongsTo(Property::class);
    }

    public function tenant(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class);
    }
}
