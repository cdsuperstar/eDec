<?php

namespace App\Http\Controllers\API;

use App\Prcoupon;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrCouponsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	// 得到公司所发布的优惠劵
	public function getCoupons()
	{
		try {
			$company_id = auth()
				->guard('api')
				->user()
				->company
				->id;
			$oProd = Product::where('company_id', '=', $company_id)
				->get(['id']);
			$oItems = Prcoupon::with('product')
				->whereIn('product_id', $oProd->toArray())
				->get();
		} catch (Exception $e) {
			return response()->json([
				'messages' => "错误啦！ " . $e->getCode(),
				'success' => false,
			]);
		}


		return response()->json([
				'success' => true,
				'data' => $oItems->toArray(),
			]
		);

	}


	//得到我选的未过期优惠劵
	public function getMyCoupons()
	{
		try {
			$oU=User::find(auth()->user()->id);
			$oItems = $oU->mycoupons()
				->where('enddate','>=',Carbon::now())
				->wherePivot('isused',false)
				->with(['product.media'])
				->get();
		} catch (Exception $e) {
			return response()->json([
				'messages' => "错误啦！ " . $e->getCode(),
				'success' => false,
			]);
		}
		return response()->json([
				'success' => true,
				'data' => $oItems->toArray(),
			]
		);

	}

	//得到我选的已使用优惠劵
	public function getMyUsedCoupons()
	{
		try {
			$oU=User::find(auth()->user()->id);
			$oItems = $oU->mycoupons()
				->wherePivot('isused',true)
				->with(['product.media'])
				->get();
		} catch (Exception $e) {
			return response()->json([
				'messages' => "错误啦！ " . $e->getCode(),
				'success' => false,
			]);
		}
		return response()->json([
				'success' => true,
				'data' => $oItems->toArray(),
			]
		);

	}

	//得到我选的已过期优惠劵
	public function getMyExpCoupons()
	{
		try {
			$oU=User::find(auth()->user()->id);
			$oItems = $oU->mycoupons()
				->where('enddate','<',Carbon::now())
				->wherePivot('isused',false)
				->with(['product.media'])
				->get();
		} catch (Exception $e) {
			return response()->json([
				'messages' => "错误啦！ " . $e->getCode(),
				'success' => false,
			]);
		}
		return response()->json([
				'success' => true,
				'data' => $oItems->toArray(),
			]
		);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	public function add(Request $request)
	{
		//
		try {
			$oItem = new Prcoupon();
			$oItem->fill($request->input());
		} catch (Exception $e) {
			return response()->json([
				'messages' => "错误啦！ " . $e->getCode(),
				'success' => false,
			]);
		}
		if ($oItem->save()) {
			return response()->json(array_merge([
					'messages' => '保存成功，ID:' . $oItem->id,
					'success' => true,
				], $oItem->toArray()
				)
			);
		} else {
			return response()->json(['messages' => $oItem->errors()->all()]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}

	public function updateItem(Request $request)
	{
		//
		try {
			$oItem = Prcoupon::find($request->input('id'));
			$oItem->fill($request->input());
		} catch (Exception $e) {
			return response()->json([
				'messages' => "错误啦！ " . $e->getCode(),
				'success' => false,
			]);
		}

		if ($oItem->save()) {
			return response()->json(array_merge([
					'messages' => '保存成功，ID:' . $oItem->id,
					'success' => true,
				], $oItem->toArray()
				)
			);
		} else {
			return response()->json(['messages' => $oItem->errors()->all()]);
		}
	}

	public function takePrcoupon(Request $request)
	{
		//

		try {
			$oItem = Prcoupon::find($request->input('couponid'));
		} catch (Exception $e) {
			return response()->json([
				'messages' => "错误啦！ " . $e->getCode(),
				'success' => false,
			]);
		}

		try {

			auth()->user()->mycoupons()->attach($oItem);
			return response()->json([
					'messages' => '领取成功！ID:'.$oItem->id,
					'success' => true,
				]
			);
		} catch (Exception $e) {
			return response()->json([
				'messages' => $e->getMessage(),
				'success' => false
			]);
		}
	}

	public function delMany(Request $request)
	{
		$aItems = Prcoupon::whereIn('id', collect($request->input('toDel'))->pluck('id'))->get();
		$oItems = $aItems->count();
		if ($oItems > 0) {
			foreach ($aItems as $key => $val) {
				$val->delete();
			}
			return response()->json([
					'messages' => '删除成功，记录:' . $oItems,
					'success' => true,
				]
			);
		} else {
			return response()->json([
				'success' => false,
				'messages' => "未知错误"
			], 500);
		}
	}

}
