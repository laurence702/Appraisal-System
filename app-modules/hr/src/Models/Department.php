<?php

namespace Modules\Hr\Models;

use Modules\Employee\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
       
   	/**
   	  * declaring table
   	*/

       public $table = 'tbl_departments';

       /**
        * The attributes that should be fillable for arrays.
        *
        * @var array
        */
   
       protected $fillable = [
           'title',
           'description',
           'status',
       ];

        public function employees(){
          return $this->hasMany(Employee::class);
        }
}
