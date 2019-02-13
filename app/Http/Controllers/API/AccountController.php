<?php

namespace App\Http\Controllers\API;

use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $info = [
            'data' => "there's a story tobe told."
        ];
        dump($info,"index");
        return response()->json($info);
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

    public function getMyAccount()
    {
        $oItem=Account::where(["user_id" => auth()->guard('api')->user()->id])->first();

        if($oItem->hasMedia('userAvatars')){
            $oItem->avatar=$oItem->getMedia('userAvatars')[0]->getFullUrl();
        }
        return response()->json($oItem);
    }
    public function updateUserAccount(Request $request)
    {
        $oItem = Account::firstOrNew(["user_id" => auth()->guard('api')->user()->id]);
        $oItem->user_id=auth()->guard('api')->user()->id;
        $oItem->fill($request->input());


        if($oItem->save()){
            if(is_file($request->file('avatar'))){
                $oItem
                    ->addMediaFromRequest('avatar')
                    ->usingName('avatar')
                    ->toMediaCollection('userAvatars');
            }
            return response()->json(array_merge([
                    'messages' => '保存成功，ID:'.$oItem->id,
                    'success' => true,
                ], $oItem->toArray()
                )
            );
        }else{
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
        dump("it's show in accountcontr.");
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
        return $request->json($request->input());
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
        dump("it's destroy in accountcontr.");

    }
}
