<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','type','address_street','address_city','photo_url','bedrooms','bathrooms','floor_area','land_size'];

    // function landlords (BelongsToMany) via Property_User table

    public function utilities(): BelongsToMany {
        return $this->belongsToMany(Utility::class)->withPivot('account_number');
    }

    public function contracts(): HasMany {
        return $this->hasMany(Contract::class);
    }
}
