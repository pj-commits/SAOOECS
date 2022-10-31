<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidation extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    // BELONGS TO
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    // PROPOSAL CHILD FORMS
    public function proofOfPayment()
    {
        return $this->hasMany(ProofOfPayment::class);
    }
    public function liquidationItem()
    {
        return $this->hasMany(LiquidationItem::class);
    }
}
