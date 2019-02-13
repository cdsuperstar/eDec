<?php

namespace App\Http\Controllers\API;

use App\Product;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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

    public function getMyProducts()
    {
        try {
            $company_id = auth()
                ->guard('api')
                ->user()
                ->company
                ->id;
            $oItems = Product::with('media')
                ->where('company_id', '=', $company_id)
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

    public function add(Request $request)
    {
        //
        $oItem = new Product();
        try {
            $oItem->company_id = auth()->guard('api')->user()->company->id;
            $oItem->fill($request->input());
        } catch (Exception $e) {
            return response()->json([
                'messages' => "错误啦！ " . $e->getCode(),
                'success' => false,
            ]);
        }
        if ($oItem->save()) {
            if ($request->files->count() > 0) {
                $oMedias = $oItem->addAllMediaFromRequest();
                foreach ($oMedias as $key => $oMedia) {
                    $oMedia->toMediaCollection('productAvatars');
                }
            }
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
    public function update(Request $request, $id){

    }


    public function updateProduct(Request $request)
    {
        //
        try {
            $oItem = Product::find($request->input('id'));
            $oItem->company_id = auth()->guard('api')->user()->company->id;
            $oItem->fill($request->input());
        } catch (Exception $e) {
            return response()->json([
                'messages' => "错误啦！ " . $e->getCode(),
                'success' => false,
            ]);
        }

        if ($oItem->save()) {
            if ($request->files->count() > 0) {
                $oMedias = $oItem->addAllMediaFromRequest();
                foreach ($oMedias as $key => $oMedia) {
                    $oMedia->toMediaCollection('productAvatars');
                }
            }
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delMany( Request $request )
    {
        try{
            $aItems=Product::whereIn('id',collect($request->input('toDel'))->pluck('id'))->get();
            $oItems=$aItems->count();
            if($oItems>0){
                foreach ($aItems as $key =>$val){
                    $val->delete();
                }
                return response()->json([
                        'messages' => '删除成功，记录:' . $oItems,
                        'success' => true,
                    ]
                );
            }else{
                return response()->json([
                    'success' => false,
                    'messages' => "未知错误"
                ], 500);
            }
        }catch (Exception $e){
            return response()->json([
                'success' => false,
                'messages' => $e->getMessage()
            ], 500);
        }
    }
}
