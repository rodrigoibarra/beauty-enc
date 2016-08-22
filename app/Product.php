<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function family()
    {
        return $this->belongsTo('App\Family');
    }

    public function division()
    {
        return $this->belongsTo('App\Division');
    }

    public function key_words()
    {
        return $this->belongsToMany(
            'App\KeyWord',
            'key_word_product',
            'key_word_id',
            'product_id'
        );
    }

    public function retailers()
    {
        return $this->belongsToMany('App\Retailer');
    }

}
