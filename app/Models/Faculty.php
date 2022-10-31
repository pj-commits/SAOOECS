<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    public function facultyUser()
    {
        return $this->belongsTo(User::class);
    }

    public function facultyDepartment()
    {
        return $this->belongsTo(Department::class);
    }
}
