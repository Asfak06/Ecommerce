<x-app-layout>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
            <div class="card card-default">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                              <th>
                                    Name
                              </th>
                              <th>
                                    Price
                              </th>
                              <th>
                                    Stock
                              </th>                              
                              <th>
                                    Edit
                              </th>
                              <th>
                                    Delete
                              </th>
                        </thead>
                        <tbody>
                              @foreach($products as $product)
                                    <tr>
                                          <td>{{ $product->name }}</td>
                                          <td>{{ $product->price }}</td>
                                          <td>{{ $product->stock }}</td>
                                          <td>
                                                <a href="{{ route('products.edit', ['product' => $product->id ]) }}" class="btn btn-warning btn-sm">Edit</a>
                                          </td>
                                          <td>
                                                <form action="{{ route('products.destroy', ['product' => $product->id ]) }}" method="post">
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



