<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    protected $guarded = [];

    // BELONGS
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    public function dept()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

     // CHILD FORMS
     public function reqItems()
     {
         return $this->hasMany(RequisitionItem::class);
     }


}
