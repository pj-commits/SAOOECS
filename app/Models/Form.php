<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;

class Form extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function proposal()
    {
        return $this->hasOne(Proposal::class);
    }
    public function liquidation(){
        return $this->hasOne(Liquidation::class);
    }
    public function narrative()
    {
        return $this->hasOne(Narrative::class);
    }
    public function requisition()
    {
        return $this->hasOne(Requisition::class);
    }

    // Form Polymorphism lol
    public function formable(){
        return $this->morphTo();
    }

    // Events Relations
    public function events(){
        return $this->belongsTo(Event::class);
    }

    

}
