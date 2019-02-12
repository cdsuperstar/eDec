<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable=["user_id",'name','ctype','address','owner','tel','phone','memo','aomemo'];

    protected $table="companys";

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

}
