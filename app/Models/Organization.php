<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function studentOrg()
    {
        return $this->belongsToMany(User::class, 'organization_user', 'organization_id', 'user_id')
        ->withPivot(['position'])
        ->withTimestamps();
        // , 'organization_user', 'organization_id', 'user_id'
    }

}
