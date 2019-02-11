<?php

namespace App\Http\Controllers\API;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
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

    public function mine()
    {
        //
        $oItem=Company::where(["user_id" => auth()->guard('api')->user()->id])->first();

        return response()->json($oItem);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function apply(Request $request)
    {
        $oItem = Company::firstOrNew(["user_id" => auth()->guard('api')->user()->id]);
        $oItem->user_id=auth()->guard('api')->user()->id;
        $oItem->fill($request->input());
        $oItem->stat="申请中";


        if($oItem->save()){
            return response()->json(array_merge([
                    'messages' => '操作成功，可在我的设置里查询状态，ID:'.$oItem->id,
                    'success' => true,
                ], $oItem->toArray()
                )
            );
        }else{
            return response()->json(['messages' => $oItem->errors()->all()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
