<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Utility extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address','contact_number','type'];

    public function properties(): BelongsToMany {
        return $this->belongsToMany(Property::class)->withPivot('account_number');
    }
}
