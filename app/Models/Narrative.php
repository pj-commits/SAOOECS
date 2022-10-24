<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narrative extends Model
{
    use HasFactory;
    protected $guarded = [];

    // BELONGS TO
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    // PROPOSAL CHILD FORMS
    public function participant()
    {
        return $this->hasMany(Participant::class);
    }
    public function commentSuggestion()
    {
        return $this->hasMany(CommentsSuggestion::class);
    }
    public function postProgram()
    {
        return $this->hasMany(PostProgram::class);
    }
    public function narrativeImage()
    {
        return $this->hasMany(NarrativeImage::class);
    }
}
