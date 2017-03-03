<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = ['name', 'email', 'company', 'group_id', 'phone', 'address', 'photo'];
    public function group(){
    	return $this->belongsTo('App\Group');
    }
}
