
<x-app-layout>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
            <div class="card ">
                <div class="card-header">Order status</div>

                <div class="card-body">
                    <form action="{{ route('orders.update', ['order' => $order->id ]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group form-control">
                              <label for="name">Pending</label>
                              <input type="radio" name="status" value="0"  
                              @if(!$order->status)
                              checked
                              @endif
                              >
                        </div>
                        <div class="form-group form-control my-2">
                              <label for="name">Shipped</label>
                              <input type="radio" name="status" value="1" 
                              @if($order->status)
                              checked
                              @endif
                              >
                        </div>                        
                        <div class="form-group">
                              <button class="form-control btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>



