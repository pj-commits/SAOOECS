<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidationItem extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    // BELONGS TO
    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
