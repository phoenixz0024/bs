<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs_Users extends Model
{
    protected $table = 'jobs_users';

    public function bonus()
    {
    	return $this->hasOne('App\Bonus');
    }

}
