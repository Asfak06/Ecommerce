<?php

namespace App\Http\Controllers;

use Mail;
use Cart;
use Session;
use Auth;
use App\Models\Order;
use App\Models\Product;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {   
        if(Cart::content()->count() == 0)
        {
            Session::flash('info', 'Your cart is still empty. do some shopping');
            return redirect()->back();
        }
        return view('checkout');
    }
  public function order(Request $request){
    dd($request->all());
    $products=$request->product_id;
    $quantity=$request->qty;
    for($i=0;$i < sizeof($products); $i++){
        $pr_stat=Product::find($products[$i]);
        if($pr_stat->stock<$quantity[$i]){
            Session::flash('info', 'Out of stock');   
            return redirect()->route('index');
        }
    }

    $order = new Order();
    $order->user_id=Auth::id();
    $order->product_ids=implode(',', $request->product_id);
    $order->product_names=implode(',', $request->product_name);
    $order->product_quantities=implode(',', $request->qty);
    $order->product_total=implode(',', $request->total);
    $order->all_total=$request->all_total;
    $order->address=$request->addr;
    $order->phone=$request->phone;
    $order->save();
    Cart::destroy();
    Session::flash('success', 'Order placed');   
    return redirect()->route('index');
  }
}
