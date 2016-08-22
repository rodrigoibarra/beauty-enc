<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['brand', 'type'];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function Profiles()
    {
        return $this->hasMany('App\Profile');
    }
}
