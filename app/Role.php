<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    // public function is($roleName)
    // {
    //     foreach ($this->roles()->get() as $role)
    //     {
    //         if ($role->name == $roleName)
    //         {
    //             return true;
    //         }
    //     }

    //     return false;
    // }
     /**
       * Set timestamps off
       */
     public $timestamps = false;
 
     /**
      * Get users with a certain role
      */
     public function users()
     {
         return $this->belongsToMany('User', 'users_roles');
    }
}
