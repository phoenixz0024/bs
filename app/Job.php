<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Job extends Model
{
    
     protected $fillable = [
        'name', 'location', 'startDate','comment', 'startTime', 'saleswaarde'
    ];


    //create Carbon instance
    protected $dates = ['startDate'];



    // Query scope -> scope + method name 
    public function scopePastJobs($query){
    	$query->where('startDate' , '<=', Carbon::now());
    }

    public function scopeFutureJobs($query){
         $query->where('startDate' , '>' , Carbon::now());
    }

     public function scopeThisMonth($query){
         $query->where('startDate' , '>' , Carbon::now())->where('startDate' , '<' , Carbon::now()->addWeeks(2));
    }

    public function scopeEarningsThisMonth($query){
        $query->whereMonth('startDate' , '=' , Carbon::now()->month);
    }


    // attributesaanelkaar
    public function setStartDateAttribute($date)
    {
     
            $newdate = date('d-m-Y' , strtotime($date));
           // dd($newdate);
    		$this->attributes['startDate'] = Carbon::createFromFormat('d-m-Y', $newdate);

            //Carbon::createFromFormat('d M Y', $this->start_dt)->setTime($this->start_hr, $this->start_min);
    }


    // A job worked by to an user
    public function user()
    {
    	return $this->belongsTo('App\User');
    }


    // a Job with users.
    // public function users()
    //  {
    //      return $this->belongsToMany('App\Jobs_Users');
    // }

    public function users()
    {
        // relaties zijn wel goed ;p want de rest doet het wel, eerste at ik daht was misschien fillable?
        return $this->belongsToMany('App\User' , 'jobs_users')->withTimestamps()->withPivot('sales','bonus_id','earnings','comment', 'nonesales'); 

        //return $this->belongsToMany('App\User')->withTimestamps();

    }

    public function bonus() {
        return $this->belongsTo('App\Bonus' , 'users_roles');
    }

    // get user id list of a job
    public function getUserListAttribute()
    {

        return $this->users->lists('id')->all();


    }
}
