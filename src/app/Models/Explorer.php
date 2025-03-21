<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explorer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'localization_id'
    ];

    public function localizations()
    {
        return $this->belongsTo(Localization::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
