<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsSuggestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    // BELONGS TO
    public function narrative()
    {
        return $this->belongsTo(Narrative::class);
    }
}
