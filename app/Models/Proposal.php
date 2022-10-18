<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function form()
    {
        return $this->morphOne(Form::class, 'formable');
    }

    // PROPOSAL CHILD FORMS
    public function preprograms()
    {
        return $this->hasMany(PrePrograms::class);
    }
    public function logisticalNeed()
    {
        return $this->hasMany(LogisticalNeed::class);
    }
    public function externalCoorganizer()
    {
        return $this->hasMany(ExternalCoorganizer::class);
    }
}
