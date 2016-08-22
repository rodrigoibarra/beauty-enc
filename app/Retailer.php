<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    protected $fillable = ['name', 'country_id'];
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function retailer_fields()
    {
        return $this->belongsToMany(
            'App\RetailerField',
            'retailer_retailer_field',
            'retailer_id',
            'retialer_field_id'
        );
    }

    public function foo()
    {
        return $this->belongsToMany('App\Product');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
