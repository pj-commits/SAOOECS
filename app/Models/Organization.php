<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function studentOrg()
    {
        return $this->belongsToMany(User::class, 'organization_user', 'organization_id', 'user_id')
        ->withPivot(['position'])
        ->withPivot(['role'])
        ->withTimestamps();
    }

    public function orgEvents(){
        return $this->hasMany(Event::class);
    }

}
