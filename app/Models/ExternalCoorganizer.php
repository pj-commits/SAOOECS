<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalCoorganizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'coorganization',
        'coorganizer',
        'email',
        'phoneNumber'
    ];

    public function proposal()
    {
        return $this->belongsToMany(Proposal::class);
    }
}
