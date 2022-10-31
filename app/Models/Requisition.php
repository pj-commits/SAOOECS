<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

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
