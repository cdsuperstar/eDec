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
