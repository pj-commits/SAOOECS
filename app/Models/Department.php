<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function departmentStaff()
    {
        return $this->hasMany(Staff::class, 'department_id');
    }

    //To Requisition
    public function departmentList()
    {
        return $this->hasOne(Requisition::class);
    }
}
