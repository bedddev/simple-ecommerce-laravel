<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;

class CartController extends Controller
{
    public function carts(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'Carts'
        ];

        return view('client.carts', $data);
    }

    public function addToCart(Request $request){
        $cart = session()->get('cart');
        $id = $request->product_id;
        $product = Product::where('id', $id)->first();

        if(isset($cart[$id])) {
            $quantityUpdate = $cart[$id]["quantity"] + $request->quantity;

            if($quantityUpdate > $product->stock){
                return response()->json(['status' => 'failed','cartCount' => count((array) session('cart')), 'code' => 202], 202);
            }

            $cart[$id]["quantity"] = $quantityUpdate;
            session()->put('cart', $cart);
            return response()->json(['status' => 'success','cartCount' => count((array) session('cart')), 'code' => 201], 201);
        }

        $cart[$id] = [
            "product_id" =>  $id,
            "title" => $product->title,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "product_stock" => $product->stock
        ];

        session()->put('cart', $cart);

        return response()->json(['status' => 'success', 'cartCount' => count((array) session('cart')), 'code' => 200], 200);
    }

    public function updateCart(Request $request)
    {
        if($request->product_id and $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->product_id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            $total = 0;

            foreach((array) session('cart') as $id => $details){
                $total += $details['price'] * $details['quantity'];
            }

            return response()->json(['message' => 'Success', 'total' => $total]);
        }
    }

    public function deleteCart(Request $request){
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            $total = 0;

            foreach((array) session('cart') as $id => $details){
                $total += $details['price'] * $details['quantity'];
            }

            return response()->json(['message' => 'Success', 'total' => $total, 'cartCount' => count((array) session('cart'))]);
        }
    }
}
