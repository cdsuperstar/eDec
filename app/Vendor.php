<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
    protected $fillable=["user_id",'name','address','owner','tel','phone','memo'];

//    protected $table="companys";

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

}
