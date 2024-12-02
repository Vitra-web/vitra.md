<?php

namespace App\Http\Controllers\Client\AjaxRequest;

use App\Http\Controllers\Controller;
use App\Models\UserFavorite;
use App\Models\UserProduct;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function toggleFavorite(Request $request) {
        $data = $request->validate([
            'user_id'=>'required|integer',
            'product_id'=>'required|integer',
            'action'=>'required|string',
        ]);

        if($data['action'] == 'add') {
            unset($data['action']);
            UserFavorite::firstOrCreate($data);
        } else {
            $userFavorite = UserFavorite::where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->first();
            if($userFavorite) {
                $userFavorite->delete();
            }
        }
        return response()->json([
            'message' => 'Product added',
            'status'=>'ok',
            'data'=>[
                'user_id'=>$data['user_id'],
                'product_id'=>$data['product_id'],
            ]

        ]);
    }

    public function addBasket(Request $request) {
        $data = $request->validate([
            'user_id'=>'required',
            'product_id'=>'required',
            'quantity'=>'required',
            'product_variant'=>'nullable|string',
            'product_moduline'=>'nullable',
        ]);

        $data['user_id'] = intval($data['user_id']);
        $data['product_id'] = intval($data['product_id']);
        $data['quantity'] = intval($data['quantity']);
//        $data['product_moduline'] = json_encode($data['product_moduline']);

        $userProduct = UserProduct::firstOrCreate($data);

//        $productsAll = UserProduct::where('user_id', $data['user_id'])->get();
        if($userProduct) {
            return response()->json([
                'message' => 'Product added',
                'status'=>'ok',
                'data'=>[
                    'quantity'=>$data['quantity'],
                    'data'=>$data,
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'Error',
                'status'=>'error',

            ]);
        }

    }

    public function removeBasket(Request $request) {
        $data = $request->validate([
            'user_id'=>'required|integer',
            'product_id'=>'required|integer',

        ]);



        $userProduct = UserProduct::where('user_id', $data['user_id'])->where('product_id',$data['product_id'] )->first();
        if($userProduct) {
            $userProduct->delete();
               return response()->json([
                'message' => 'Product updated',
                'status'=>'ok',

            ]);
        } else {
            return response()->json([
                'message' => 'Error',
                'status'=>'error',

            ]);
        }

    }

    public function quantityBasket(Request $request) {
        $data = $request->validate([
            'user_id'=>'required|integer',
            'product_id'=>'required|integer',
            'quantity'=>'required|integer',
        ]);


        $userProduct = UserProduct::where('user_id', $data['user_id'])->where('product_id',$data['product_id'] )->update(['quantity'=>$data['quantity']]);
        if($userProduct) {

            return response()->json([
                'message' => 'Product removed',
                'status'=>'ok',

            ]);
        } else {
            return response()->json([
                'message' => 'Error',
                'status'=>'error',

            ]);
        }

    }

}
