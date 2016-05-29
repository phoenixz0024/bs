<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'postcode', 'street','city', 'country', 'phone', 'gender' , 'license', 'housenumber', 'birthdate' ,'birthplace' ,'birthcountry' , 'licensevalid' ,'bankaccount' ,'helpname','helpnumber'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    * Get the roles a user has
    */
    public function roles()
    {
        return $this->belongsToMany('App\Role' , 'users_roles');
    }
    
    /**
      * Find out if User is an employee, based on if has any roles
      *
      * @return boolean
    */
    public function isEmployee()
    {
         $roles = $this->roles->toArray();
         return !empty($roles);
    }

    /**
      * Find out if user has a specific role
      *
      * $return boolean
    */
     public function hasRole($check)
     {
         return in_array($check, array_flatten($this->roles->toArray(), 'name'));
     }

     // omdat ik in een model functies declareer, kan ik die functies dus gebruiken. ook heeel nice
     // jup Auth::user is het user model oke heel nice, maar ik moet mijn database nog migraten :p dan kan ik niet meer op register pagina komen omdat er geen admin is xD
     // haha daarom seeders, voeg je standaard jezelf toe en kun je eraltijd in
      /**
      * Get key in array with corresponding value
      *
      * @return int
      */
     private function getIdInArray($array, $term)
     {
         foreach ($array as $key => $value) {
             if ($value == $term) {
                 return $key;
             }
         }
 
         throw new UnexpectedValueException;
     }

       /**
     * Add roles to user to make them a concierge
      */
     public function makeEmployee($title)
     {
         $assigned_roles = array();
 
         $roles = array_fetch(Role::all()->toArray(), 'name');
 
         switch ($title) {
             case 'super_admin':
                 $assigned_roles[] = $this->getIdInArray($roles, 'edit_customer');
                 $assigned_roles[] = $this->getIdInArray($roles, 'delete_customer');
             case 'admin':
                 $assigned_roles[] = $this->getIdInArray($roles, 'create_customer');
             case 'concierge':
                 $assigned_roles[] = $this->getIdInArray($roles, 'add_points');
                 $assigned_roles[] = $this->getIdInArray($roles, 'redeem_points');
                 break;
             default:
                 throw new \Exception("The employee status entered does not exist");
         }
 
         $this->roles()->attach($assigned_roles);
     }



     // A user can have many Jobs 
     // public function jobs()
     // {
     //    return $this->hasMany('App\Jobs');
     // }


     // Get the jobs a users has
    //   public function jobs()
    // {
    //     return $this->belongsToMany('App\Jobs_Users');
    // }
     // andere conventie toevoegen als tweede argument
     public function jobs()
     {
        return $this->belongsToMany('App\Job' , 'jobs_users')->withTimestamps()->withPivot('sales','bonus_id' ,'earnings','comment','nonesales');

     }

     public function questions()
     {
        return $this->belongsToMany('App\Question' , 'question_user')->withTimestamps()->withPivot('correct','questionmade' ,'answer');

     }

     public function tests()
     {
         return $this->belongsToMany('App\Test' , 'tests_users')->withTimestamps()->withPivot('testscore');
     }

     


     
}
