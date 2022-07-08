<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Validator;
use Str;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ShopController extends Controller
{
    public function create(Request $request){

        $validator = Validator($request->all(), [
            'name_shop' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'path' => 'required',
            'desc' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('home')->withErrors($validator)->withInput();
        }else{
            $path = $request->file('path');
            $extension_path = $path->getClientOriginalExtension();
            $full_name_path = Auth::user()->email."-".Str::random(20).".".$extension_path;
            $path->move(public_path('shop'), $full_name_path);

            Shop::create([
                'user_id' => Auth::user()->id,
                'name_shop' => $request->name_shop,
                'phone' => $request->phone,
                'address' => $request->address,
                'desc' => $request->desc,
                'path' => $full_name_path,
            ]);

            return redirect()->route('home');
        }
    }

    public function detail(){
        $data = [
            'title' => 'Shop Detail',
            'shop' => Shop::first()
        ];

        return view('admin.shop.detail', $data);
    }

    public function update(Request $request){

        $validator = Validator($request->all(), [
            'name_shop' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'desc' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('shopDetail')->withErrors($validator)->withInput();
        }else{


            if ($request->hasFile('path')) {

                $path = $request->file('path');
                $extension_path = $path->getClientOriginalExtension();
                $full_name_path = Auth::user()->email."-".Str::random(20).".".$extension_path;
                $path->move(public_path('shop'), $full_name_path);

                $paths = public_path().'/shop/'. Auth::user()->shop->path;
                if(file_exists($paths)){
                    unlink($paths);
                }

                Shop::where('id', Auth::user()->shop->id)->update([
                    'name_shop' => $request->name_shop,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'desc' => $request->desc,
                    'path' => $full_name_path,
                ]);

                return redirect()->route('shopDetail')->with('success', 'Shop updated');

            }else{
                Shop::where('id', Auth::user()->shop->id)->update([
                    'name_shop' => $request->name_shop,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'desc' => $request->desc,
                ]);

                return redirect()->route('shopDetail')->with('success', 'Shop updated');
            }
        }
    }

    public function updatePassword(Request $request){
        $validator = Validator($request->all(), [
            'password' => 'required|string|confirmed',
        ]);

        if($validator->fails()){
            return redirect()->route('home')->with('failed', 'Failed to update password')->withErrors($validator)->withInput();
        }else{

            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('home')->with('success', 'Password Changed');
        }

    }

}
