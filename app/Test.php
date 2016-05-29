<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    
    protected $fillable = [
        'name', 'modulelink', 'comment'
    ]; 

    protected $table = 'tests';

    
    public function questions()
    {
        return $this->belongsToMany('App\Question' , 'questions_tests');
    }

    public function users()
    {
    	return $this->belongsToMany('App\Test' , 'tests_users')->withTimestamps()->withPivot('testscore');
    }
}
