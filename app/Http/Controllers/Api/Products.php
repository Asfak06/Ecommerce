<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Products extends Controller
{

    public function __construct(){
        auth()->setDefaultDriver('api');
       $this->middleware('auth:api');        
    }

    public function get_products(){
       $product = Product::all();       
       return response($product);
    }

    public function add_order(Request $request){

        $request->validate([
            'product_ids' => 'required|array',
            'product_names' => 'required|array',
            'product_quantities' => 'required|array',
            'product_total'=>'required|array',
            'all_total'=>'required',
            'address'=>'required',
            'phone'=>'required',
        ]);

        $order = new Order();
        $order->user_id=Auth::id();
        $order->product_ids=implode(',', $request->product_ids);
        $order->product_names=implode(',', $request->product_names);
        $order->product_quantities=implode(',', $request->product_quantities);
        $order->product_total=implode(',', $request->product_total);
        $order->all_total=$request->all_total;
        $order->status=0;
        $order->address=$request->address;
        $order->phone=$request->phone;
        $order->save();

            return response()->json([
                "message"=>'Order saved',
                "data"=>$order
            ]);
    }


    public function add_products(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image'
        ]);

        $product = new Product;

        $product_image = $request->image;

        $product_image_new_name = time() . $product_image->getClientOriginalName();

        $product_image->move('uploads/products', $product_image_new_name);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image = 'uploads/products/' . $product_image_new_name;

        $product->save();
            return response()->json([
                "message"=>'Product saved',
                "data"=>$product
            ]);
    }
}
