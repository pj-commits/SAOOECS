<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    public function orgs(){
        return $this->belongsTo(Organization::class);
    }

    public function eventForm(){
        return $this->hasMany(Form::class);
    }
}
