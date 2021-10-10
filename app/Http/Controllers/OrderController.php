<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use Session;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index')->with('orders',Order::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('orders.edit', ['order' => Order::find($id) ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order =Order::find($id);
        if($request->status){
            $products=explode(',', $order->product_ids);
            $quantity=explode(',', $order->product_quantities);     
            for($i=0;$i < sizeof($products); $i++){
                $pr=Product::find($products[$i]);
                if($pr->stock>=$quantity[$i]){
                  $pr->stock=$pr->stock - $quantity[$i];
                  $pr->save();
                }else{
                    Session::flash('info', 'Stock mismatch');
                    return redirect()->route('orders.index');                     
                }
            }                   
        }
        
        $order->status=$request->status;
        $order->save();
        Session::flash('success', 'Order updated.');

        return redirect()->route('orders.index');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);        

        $order->delete();

        Session::flash('success', 'Order deleted.');

        return redirect()->back();
    }

    public function search(Request $request)
    { 
        if($request->user_id && $request->product){
            $value='%'.$request->product.'%';
            $order=Order::where('user_id',$request->user_id)->where('product_names' ,'LIKE' , $value)->get();
        }elseif($request->user_id && !$request->product){
            $order=Order::where('user_id',$request->user_id)->get();
        }elseif(!$request->user_id && $request->product){
            $value='%'.$request->product.'%';
            $order=Order::where('product_names' ,'LIKE' , $value)->get();
        }else{
            $order=Order::all();
        }

        return view('orders.index')->with('orders',$order);
    }       
}
