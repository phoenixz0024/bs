<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions_Tests extends Model
{
    
        protected $fillable = [
        'answer_id', 'question_id',  'test_id', 'coorect' , 'questionmade',
    ]; 
    //

    protected $table = 'answer_questions';

    
}
