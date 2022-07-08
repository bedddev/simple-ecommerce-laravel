<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   


        if(!Auth::user()->shop){
            return view('admin.shop.create');
        }else{

            $data = [
                'title' => 'Dashboard',
                'product' => Product::all()->count(),
                'category' => Category::all()->count(),
                'sales' => Order::where('status', 5)->sum('total'),
                'order' => Order::where('status', 5)->count(),
                'newOrder' => Order::all()->sortByDesc('id')->take(5)
            ];

            return view('admin.index', $data);
        }

    }
}
