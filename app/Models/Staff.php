<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'position'
    ];

    // BELONGS TO
    public function facultyUser()
    {
        return $this->belongsTo(User::class);
    }

    public function staffDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function formsSao(){
        
        return $this->hasMany(Form::class, 'sao_staff_id');
    }

}
