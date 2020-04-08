<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'image', 'warranty', 'expiry', 'cost'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
