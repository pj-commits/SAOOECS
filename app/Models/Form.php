<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_name',
        'event_title',
    ];

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

    public function byOrg(){
        return $this->belongsTo(OrganizationUser::class, 'organization_user_id');
    }

    // Form Polymorphism lol
    public function formable(){
        return $this->morphTo();

    }

}
