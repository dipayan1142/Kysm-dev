<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center_permission_module extends Model
{
	public $timestamps = false;
    protected $table='center_permission_modules';
	protected $fillable = [
        'center_id', 
        'module_id', 
    ];
	
   
}
