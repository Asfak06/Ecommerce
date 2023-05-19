@extends('layouts.front')
@section('page')
<div class="container-fluid">
<div class="row medium-padding120 bg-border-color">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="order">
      <h2 class="h1 order-title align-center">Your Order</h2>
      <form action="{{route('order-submit')}}" method="post" class="cart-main">
            @csrf
            <table class="shop_table cart">
                  <thead class="cart-product-wrap-title-main">
                        <tr>
                              <th class="product-thumbnail">Product</th>
                              <th class="product-quantity">Quantity</th>
                              <th class="product-subtotal">Total</th>
                        </tr>
                  </thead>
                  <tbody>
                        @foreach(Cart::content() as $item)
                        <tr class="cart_item">
                              <td class="product-thumbnail">
                                    <div class="cart-product__item">
                                          <div class="cart-product-content">
                                                <h5 class="cart-product-title" >{{ $item->name }} </h5>
                                          </div>
                                    </div>
                              </td>
                              <td class="product-quantity">
                                    <div class="quantity" >
                                          x {{ $item->qty }}
                                    </div>
                              </td>
                              <td class="product-subtotal">
                                    <h5 class="total amount" name="total[]">${{ $item->total() }}</h5>
                              </td>
                        </tr>
                        <input type="hidden" name="product_id[]" value="{{$item->id}}">
                        <input type="hidden" name="product_name[]" value="{{$item->name}}">
                        <input type="hidden" name="qty[]" value="{{$item->qty}}">
                        <input type="hidden" name="total[]" value="{{$item->total()}}">
                        @endforeach
                        <tr class="cart_item total">
                              <td class="product-thumbnail">
                                    <div class="cart-product-content">
                                          <h5 class="cart-product-title">Total:</h5>
                                    </div>
                              </td>
                              <td class="product-quantity">
                              </td>
                              <td class="product-subtotal">
                                    <h5 class="total amount" >${{number_format(Cart::total())}}</h5>
                                    <input type="hidden"name="all_total" value="{{ Cart::total() }}">
                              </td>
                        </tr>
                  </tbody>
            </table>
            <div class="cheque">
                  <div class="">
                        <input style="background-color: white; border: solid; border-radius: 90;" type="text" name="phone" placeholder="Enter phone number">
                        <textarea style="background-color: white; border: solid; border-radius: 90;"  name="addr" id="" cols="30" rows="5" placeholder="Type your delivery address"></textarea>
                        <button class="btn" style="color: black;" type="submit">Place Order(s)</button>
                  </div>
            </div>
      </form>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection