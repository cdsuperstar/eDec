<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prcoupon extends Model
{
    //
	protected $fillable=["product_id","name","discount","total","maximum","startdate","enddate","memo"];

	public function product()
	{
		return $this->belongsTo('App\Product');
	}
}
