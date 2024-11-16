<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','address_street','address_city','photo_url','bedrooms','bathrooms','floor_area','land_size'];

    // function landlords (BelongsToMany) via Property_User table

    // function utilities (BelongsToMany) via Property_Utility table
    public function utilities(): BelongsToMany {
        return $this->belongsToMany(Utility::class);
    }

    // function contracts (HasMany) via Contracts table -> property foreign key
}
