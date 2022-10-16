<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationUser extends Model
{
    use HasFactory;

    // public function org()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
//     public function adviser(){
//         // return $this->belongsTo(Approver::class, 'approver_adviser_id', 'id');
//     }
}
