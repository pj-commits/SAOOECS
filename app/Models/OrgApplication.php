<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgApplication extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
