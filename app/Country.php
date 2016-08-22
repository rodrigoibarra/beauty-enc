<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $fillable = ['country'];

    public function retailers()
    {
        return $this->hasMany('App\Retailer');
    }

    public function profiles()
    {
        return $this->hasMany('App\Profiles');
    }
}
