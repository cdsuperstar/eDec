<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prcoupon extends Model
{
    //
	protected $fillable=["product_id","name","discount","total","maximum","startdate","enddate","memo"];

	protected $casts = [
		'discount' => 'float',
	];

	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	public function users()
	{
		return $this->belongsToMany('App\User','user_prcoupon')->withPivot(['id','isused']);
	}


}
