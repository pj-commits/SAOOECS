<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orgs(){
        return $this->belongsTo(Organization::class);
    }

    public function eventForm(){
        return $this->hasMany(Form::class);
    }
}
