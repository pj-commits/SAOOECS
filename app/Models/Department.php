<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

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
