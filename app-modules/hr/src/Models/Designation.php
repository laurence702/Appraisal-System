<?php

namespace Modules\Hr\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Designation extends Model
{
    use HasFactory, SoftDeletes;
  

   	protected $table = 'tbl_designations';


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

    public $timestamps = ['created_at','updated_at','deleted_at'];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;
}
