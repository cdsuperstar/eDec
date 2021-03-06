<?php
/**
 * @copyright 2018 Manfred047
 * @author Emanuel Chablé Concepción <manfred@manfred047.com>
 * @version 1.0.0
 * @website: https://manfred047.com
 * @github https://github.com/Manfred047
 */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
	return response()->json([
		'copyright' => 'xxx',
		'author' => 'lucifer',
		'email' => '181977814@qq.com',
		'website' => 'website',
		'github' => 'cdsuperstar'
	]);
});
Route::name('api.')
	->prefix('/v1')
	->middleware(['client.oauth', 'auth:api'])
	->group(function () {

		Route::apiResource('user', 'UserController')
			->only('index');

	});

Route::name('api.business.')
//    ->namespace('API')
	->prefix('/v1')
	->group(function () {
		Route::middleware(['client.oauth', 'auth:api'])
			->group(function () {
				Route::get('accounts', 'API\AccountController@index')
					->name('getallAccounts');
				Route::get('getMyaccount', 'API\AccountController@getMyAccount')
					->name('getallAccounts');
				Route::post('updateAccount', 'API\AccountController@updateUserAccount')
					->name('updateUserAccount');

			});

		//公司
		Route::prefix('company')
			->middleware(['client.oauth', 'auth:api'])
			->group(function () {
				Route::post('apply', 'API\CompanyController@apply')
					->name('companyApply');
				Route::get('mine', 'API\CompanyController@mine')
					->name('companyMine');
			});

		// 商品
		Route::prefix('product')
			->middleware(['client.oauth', 'auth:api'])
			->group(function () {
				Route::post('add', 'API\ProductController@add')
					->name('productAdd');
				Route::post('updateProduct', 'API\ProductController@updateProduct')
					->name('productUpdate');

				Route::get('getMyProducts', 'API\ProductController@getMyProducts')
					->name('productMyProducts');
				Route::delete('delMany', 'API\ProductController@delMany')
					->name('productDelMany');

			});


		Route::prefix('product')->group(function () {
			Route::get('getAllProducts/{ctype?}/{search?}', 'API\ProductController@getAllProducts')
				->name('productAllProducts');
			Route::post('searchAllProducts', 'API\ProductController@searchAllProducts')
				->name('productSearchAllProducts');
		});

		// 打折劵
		Route::prefix('prcoupon')
			->middleware(['client.oauth', 'auth:api'])
			->group(function () {
				Route::post('add', 'API\PrCouponsController@add')
					->name('prcouponAdd');
				Route::post('updateItem', 'API\PrCouponsController@updateItem')
					->name('prcouponUpdateItem');

				Route::post('takePrcoupon', 'API\PrCouponsController@takePrcoupon')
					->name('prcouponTakePrcoupon');

				Route::get('getCoupons', 'API\PrCouponsController@getCoupons')
					->name('prcouponGetCoupons');
				//得到未过期
				Route::get('getMyCoupons', 'API\PrCouponsController@getMyCoupons')
					->name('prcouponGetMyCoupons');
				//得到已用
				Route::get('getMyUsedCoupons', 'API\PrCouponsController@getMyUsedCoupons')
					->name('prcouponGetMyUsedCoupons');
				//得到未过期
				Route::get('getMyExpCoupons', 'API\PrCouponsController@getMyExpCoupons')
					->name('prcouponGetMyExpCoupons');

				Route::delete('delMany', 'API\PrCouponsController@delMany')
					->name('prcouponDelMany');
			});

		Route::prefix('prcoupon')->group(function () {
//			Route::post('searchAllProducts', 'API\ProductController@searchAllProducts')
//				->name('productSearchAllProducts');

		});


//        Route::apiResource('/companys','CompanyController');
	});