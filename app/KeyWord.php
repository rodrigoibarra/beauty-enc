<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyWord extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    public function products()
    {
        return $this->belongsToMany(
            'App\Product',
            'key_word_product',
            'key_word_id',
            'product_id'
        );

        // return $this->belongsToMany(
        //     'App\RetailerField',
        //     'retailer_retailer_field',
        //     'retailer_id',
        //     'retialer_field_id'
        // );
    }
}
