<x-app-layout>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
            <div class="card card-default">

                <form class="my-3 m-auto" method="POST" action="{{route('order-search')}}">
                  @csrf
                  <div class="row">
                        <div class="col-4">
                           <input type="number" name="user_id" placeholder="User Id" class="form-control">
                        </div>
                        <div class="col-4">
                            <input type="text" name="product" placeholder="Product Name" class="form-control">
                        </div> 
                        <div class="col-4">
                            <input type="submit" value="Filter" class="btn btn-outline-secondary form-control">
                        </div> 
                  </div>

                   
                    
                </form>    
                              
                <div class="card-header">Products</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                              <th>
                                    order ID
                              </th>
                              <th>
                                    User ID
                              </th>
                              <th>
                                    Products
                              </th>  
                              <th>
                                    Total cost
                              </th>
                              <th>
                                    status
                              </th>                                                                                           
                              <th>
                                    Edit
                              </th>
                              <th>
                                    Delete
                              </th>
                        </thead>
                        <tbody>
                              @foreach($orders as $order)
                                    <tr>
                                          <td>{{ $order->id }}</td>
                                          <td>{{ $order->user_id }}</td>
                                          <td>
                                          @php
                                          $names=explode(',',$order->product_names);
                                          $qties=explode(',',$order->product_quantities);
                                          for($i=0; $i < sizeof($names); $i++){
                                                echo $names[$i] . '| quantity: ' . $qties[$i] . '<br>';
                                          }
                                          @endphp
                                          </td>
                                          <td>{{$order->all_total}}</td>
                                          <td>
                                                @if($order->status)
                                                 Shipped
                                                @else
                                                 pending
                                                @endif

                                          </td>
                                          <td>
                                                <a href="{{ route('orders.edit', ['order' => $order->id ]) }}" class="btn btn-warning btn-sm">Edit</a>
                                          </td>
                                          <td>
                                                <form action="{{ route('orders.destroy', ['order' => $order->id ]) }}" method="post">
                                                      {{ csrf_field() }}
                                                      {{ method_field('DELETE') }}
                                                      <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                          </td>
                                    </tr>
                              @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>



