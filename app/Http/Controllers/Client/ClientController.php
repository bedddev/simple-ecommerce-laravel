<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderDetail;
use Validator;
use Str;

class ClientController extends Controller
{
    public function index(){

        if(!Shop::exists()){
            return redirect()->route('register');
        }

        $data = [
            'shop' => Shop::first(),
            'product' => Product::all()->sortByDesc('id')->take(8),
            'category' => Category::all()->sortByDesc('id')->take(4),
            'title' => 'Home'
        ];

        return view('client.index', $data);
    }

    public function products(){
        $data = [
            'shop' => Shop::first(),
            'product' => Product::orderBy('id', 'DESC')->paginate(16),
            'category' => Category::all()->sortByDesc('id'),
            'title' => 'Products'
        ];

        return view('client.products', $data);
    }

    public function searchProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'product' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('clientHome')->withErrors($validator)->withInput();
        }else{
            
            $search = str_replace(' ', '-', strtolower($request->product));

            $data = [
                'title' => 'Result',
                'shop' => Shop::first(),
                'product' => Product::where('title', 'LIKE', '%'.$search.'%')->orderBy('id', 'DESC')->paginate(20),
                'search' => $request->product
            ];

            return view('client.productSearch', $data);

        }
    }

    public function category(){
        $data = [
            'shop' => Shop::first(),
            'category' => Category::orderBy('id', 'DESC')->paginate(12),
            'title' => 'Products'
        ];

        return view('client.category', $data);
    }

    public function categoryProducts($category){
        $data = [
            'shop' => Shop::first(),
            'category' => Category::where('name', $category)->first(),
            'title' => 'Category - '.str_replace('-', ' ', ucwords($category))
        ];

        return view('client.categoryProducts', $data);
    }

    public function productDetail($product){

        $product = Product::where('title', $product)->first();

        if($product->category->product->count() > 1){
            $recomendationProducts = $product->category->product->take(8);
        }else{
            $recomendationProducts = Product::all()->sortByDesc('id')->take(8);
        }

        $data = [
            'shop' => Shop::first(),
            'product' => $product,
            'recomendationProducts' => $recomendationProducts,
            'title' => str_replace('-', ' ', ucwords($product->title))
        ];

        return view('client.productDetail', $data);
    }

    public function checkout(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'Checkout'
        ];

        return view('client.checkout', $data);
    }

    public function checkoutSave(Request $request){
        $validator = Validator($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('clientCheckout')->withErrors($validator)->withInput();
        }else{
            $order_code = Str::random(3).'-'.Date('Ymd');

            if(session('cart')){
                $total = 0;
                foreach((array) session('cart') as $id => $details){
                    $total += $details['price'] * $details['quantity'];

                    $data[$id] = [
                        'order_code' => $order_code,
                        'title' => $details['title'],
                        'price' => $details['price'],
                        'quantity' => $details['quantity'],
                    ];
                }

                Order::create([
                    'shop_id' => Shop::first()->id,
                    'order_code' => $order_code,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'note' => $request->note,
                    'total' => $total,
                    'status' => 0
                ]);

                OrderDetail::insert($data);

                session()->forget('cart');

                return redirect()->route('clientOrderCode', $order_code);
            }

        }
    }

    public function successOrder($order_code){
        $data = [
            'shop' => Shop::first(),
            'order_code' => $order_code,
            'title' => 'Checkout'
        ];

        return view('client.success-order', $data);
    }
    

    public function checkOrder(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'Check Order'
        ];

        return view('client.check-order', $data);
    }

    public function checkOrderStatus(Request $request){

        $order = Order::where('order_code', $request->order_code)->first();


        if($order){
            $data = [
                'shop' => Shop::first(),
                'order' => $order,
                'orderDetail' => OrderDetail::where('order_code', $request->order_code)->get(),
                'title' => 'Check Order'
            ];
            return view('client.check-order', $data);

        }

        $data = [
            'shop' => Shop::first(),
            'title' => 'Check Order'
        ];

        return view('client.check-order', $data);
    }

    public function about(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'About'
        ];

        return view('client.about', $data);
    }
}
