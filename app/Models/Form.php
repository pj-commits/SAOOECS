<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'createdBy',
        'formType',
        'orgName',
        'controlNumber',
        'eventTitle',
        'currApprover',
        'status',
        'adviserIsApprove',
        'saoIsApprove',
        'acadServIsApprove',
        'financeIsApprove',
        'remarks',
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

}
