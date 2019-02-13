<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    //
    use HasMediaTrait;

    protected $fillable=['name','price','unit','memo'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
