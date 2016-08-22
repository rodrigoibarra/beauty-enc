<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailerField extends Model
{
    protected $fillable = ['name'];
    public function retailers()
    {
        return $this->belongsToMany(
            'App\Retailer',
            'retailer_retailer_field',
            'retailer_id',
            'retialer_field_id'
        );
    }
}
