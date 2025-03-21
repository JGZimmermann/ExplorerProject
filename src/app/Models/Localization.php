<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Explorer;

class Localization extends Model
{
    use HasFactory;
    protected $fillable = [
        'latitude',
        'longitude'
    ];

    public function explorers()
    {
        return $this->hasMany(Explorer::class);
    }
}
