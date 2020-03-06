<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function setTitleAttribute($value)
    {
     $this->attributes['title'] = $value;
     $this->attributes['slug'] = str_slug($value);
    }
    public function getUrlAttribute()
    {
        return \route('questions.show', $this->slug);
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getStatusAttribute()
    {
        if ($this->answers_count >0) {
            if ($this->answered_best_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    //Convert body from text to HTML
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
    //create relationship between question and answer model
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
