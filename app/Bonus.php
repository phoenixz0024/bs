<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    //
    protected $fillable = [
        'name', 'value', 'nos'
    ]; 

      protected $table = 'bonus';

     public function user()
    {
    	return $this->belongsTo('App\Jobs_Users');
    }

     public function getBonusIdListAttribute()
    {

        return $this->lists('id')->all();


    }
}
