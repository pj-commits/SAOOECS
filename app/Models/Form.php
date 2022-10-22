<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function preparedBy(){
        return $this->belongsTo(OrganizationUser::class, 'prep_by', 'user_id');
    }

    public function myOrg(){
        return $this->belongsTo(OrganizationUser::class, 'organization_id');
    }
}
