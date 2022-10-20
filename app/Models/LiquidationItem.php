<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidationItem extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    // BELONGS TO
    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
