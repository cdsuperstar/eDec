<?php

namespace App\Http\Controllers\API;

use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

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

    public function updateUserAccount(Request $request)
    {
        $AccoutItem = Account::firstOrNew(["user_id" => auth()->guard('api')->user()->id]);
        $AccoutItem->user_id=auth()->guard('api')->user()->id;
        $AccoutItem->fill($request->input());


        if($AccoutItem->save()){
            if(is_file($request->file('avatar'))){
                $AccoutItem
                    ->addMediaFromRequest('avatar')
                    ->usingName('avatar')
                    ->toMediaCollection('userAvatars');
            }
            return $request->json($request->input());
        }else{
            return "error";
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
