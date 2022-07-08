<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(){
        $data = [
            'orders' => Order::all()->sortByDesc('id'),
            'title' => 'Orders'
        ];

        return view('admin.order.index', $data);
    }

    public function detail($order_code){
        $data = [
            'order' => Order::where('order_code', $order_code)->first(),
            'orderDetail' => OrderDetail::where('order_code', $order_code)->get(),
            'title' => 'Order Detail - '.$order_code
        ];

        return view('admin.order.detail', $data);
    }

    public function updateStatus(Request $request, $order_code){
        $order = Order::where('order_code', $order_code);
        $orderDetail = OrderDetail::where('order_code', $order_code)->get();
        
        if($request->status == 5){

            foreach($orderDetail as $item){
                $product = Product::where('title', $item->title);
                $updateStock = $product->first()->stock - $item->quantity;
                $product->update(['stock' => $updateStock]);
            }

        }else{

            if($order->first()->status == 5){
                foreach($orderDetail as $item){
                    $product = Product::where('title', $item->title);
                    $updateStock = $product->first()->stock + $item->quantity;
                    $product->update(['stock' => $updateStock]);
                }
            }

        }

        $order->update(['status' => $request->status]);

        return redirect()->route('orderDetail', $order_code)->with('success', 'Order Status Changed');
    }

    public function delete($order_code){
        Order::where('order_code', $order_code)->delete();
        OrderDetail::where('order_code', $order_code)->delete();

        return redirect()->route('orders')->with('success', 'Order Deleted');
    }
}
