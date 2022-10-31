<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    // PROPOSAL CHILD FORMS
    public function req()
    {
        return $this->belongsTo(Requisition::class);
    }
}
