
<x-app-layout>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
            <div class="card ">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{ route('products.update', ['product' => $product->id ]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                              <label>Price</label>
                              <input type="number" name="price" value="{{ $product->price }}" class="form-control">
                        </div>
                        <div class="form-group">
                              <label>Stock</label>
                              <input type="number" name="stock" value="{{ $product->stock }}" class="form-control">
                        </div>                        
                        <div class="form-group">
                              <label for="image">Image</label>
                              <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                              <label for="description">Description</label>
                              <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                              <button class="form-control btn btn-success">Save Product</button>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>



