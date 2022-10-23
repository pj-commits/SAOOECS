<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function fromOrgUser(){
        return $this->belongsTo(OrganizationUser::class, 'prep_by', 'user_id');
    }

    public function myOrg(){
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function tableFilter($query, array $filters){
        if($filters['form_type'] ?? false){
            $query->where('form_type', 'like', '%' . request('form_type') . '%');
        }

        if($filters['search'] ?? false){
            $query->where('event_title', 'like', '%' . request('search') . '%')
                ->orwhere('description', 'like', '%' . request('search') . '%')
                ->orwhere('organization', 'like', '%' . request('search') . '%');
        }
        
    }
    // public function getRouteKeyName()
    // {

    //     return 'forms';
    // }

    public function getSao(){
        return $this->belongsTo(Staff::class, 'sao_staff_id');
    }
}


