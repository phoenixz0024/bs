<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $fillable = [
        'answer' , 'user_id'
    ]; 

    protected $table = 'answers';

      public function questions()
    {
        return $this->belongsToMany('App\Question' , 'answer_questions')->withPivot('correct','questionmade');
    }
}
