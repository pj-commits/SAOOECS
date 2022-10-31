<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalCoorganizer extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];
    
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
