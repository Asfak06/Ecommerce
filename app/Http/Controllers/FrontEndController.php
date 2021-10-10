<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('index', ['products' => Product::paginate(3)]);
    }

    public function singleProduct($id)
    {
        return view('single', ['product' => Product::find($id)]);
    }
    public function search(Request $request)
    {  
                 $request->validate([
                     "start_price"=>"required",
                     "end_price"=>"required",
                ]);

        $result=Product::where('price','>=' , $request->start_price)->where('price','<=' , $request->end_price)->paginate(3); 
        return view('index', ['products' => $result]);
    }    
}
