<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /*
        Fields:

        user_id
        first_name
        last_name
        country_id
        brand_id

    */

    protected $fillable = ['first_name', 'last_name', 'country_id', 'brand_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function division()
    {
        return $this->belongsTo('App\Division');
    }
}
