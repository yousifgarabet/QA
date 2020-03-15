<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     //Convert body from text to HTML
     public function getBodyHtmlAttribute()
     {
         return \Parsedown::instance()->text($this->body);
     }

     public static function boot()
     {
         parent::boot();
         static::created(function($answer)
         {
             $question =  $answer->question;
            $question->increment('answers_count');
            if ($question->best_answer_id == $answer->id) {
                $question->best_answer_id=null;
                $question->save();
            }
         });

         static::deleted(function($answer){
             $answer->question->decrement('answers_count');
         });
     }
     public function getCreatedDateAttribute()
     {
         return $this->created_at->diffForHumans();
     }
     public function getStatusAttribute()
     {
         return $this->id ==$this->question->best_answer_id? 'vote-accepted': '';
     }
}
