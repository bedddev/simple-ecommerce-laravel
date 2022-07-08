<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Str;
use Auth;
class CategoryController extends Controller
{
    public function index(){

        $data = [
            'title' => 'Category',
            'category' => Category::all()->sortBy('DESC')
        ];

        return view('admin.category.index', $data);
    }

    public function create(){

        $data = [
            'title' => 'Create category'
        ];

        return view('admin.category.create', $data);
    }

    public function check(Request $request){
        $name = Category::where('name', $request->name)->exists();
        if($name){
            return response()->json(['status' => 'success', 'messages' => 'not available'], 200);
        }else{
            return response()->json(['status' => 'success', 'messages' => 'available'], 201);
        }
    }

    public function save(Request $request){
        $validators = Validator($request->all(), [
            'path' => 'required',
            'name' => 'required|unique:categories',
        ]);

        if($validators->fails()){
            return redirect()->route('categoryCreate')->withErrors($validators)->withInput();
        }else{
            $path = $request->file('path');
            $extension_path = $path->getClientOriginalExtension();
            $full_name_path = Str::random(20).".".$extension_path;
            $path->move(public_path('shop/products/'), $full_name_path);

            Category::create([
                'shop_id' => Auth::user()->shop->id,
                'name' => $request->name,
                'path' => $full_name_path
            ]);

            return redirect()->route('category');

        }
    }

    public function delete($id, $path){
        $paths = public_path().'/shop/products/'. $path;
        if(file_exists($paths)){
            unlink($paths);
        }

        Category::destroy($id);

        return redirect()->route('category')->with('success', 'Category deleted');
    }
}
