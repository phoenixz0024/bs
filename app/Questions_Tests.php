<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions_Tests extends Model
{
    
        protected $fillable = [
        'question_id', 'test_id', 'comment' 
    ]; 
    //

    protected $table = 'questions_tests';

    
}
