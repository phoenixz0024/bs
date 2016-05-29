<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //

      protected $fillable = [
        'name', 'a', 'b' ,'c' ,'d' ,'answer'
    ]; 

      protected $table = 'questions';

 

    public function tests()
    {
        // relaties zijn wel goed ;p want de rest doet het wel, eerste at ik daht was misschien fillable?
        return $this->belongsToMany('App\Test' , 'questions_tests'); 

        //return $this->belongsToMany('App\User')->withTimestamps();

    }

    public function users()
    {
        return $this->belongsToMany('App\User' , 'question_user')->withPivot('correct' ,'answer', 'questionmade');
    }

     public function answers()
    {
        return $this->belongsToMany('App\Answer' , 'answer_questions')->withPivot('correct' , 'questionmade');
    }

 public function getTestListAttribute()
    {

        return $this->tests->lists('id')->all();


    }

}
