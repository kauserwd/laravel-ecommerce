@include('admin.inc.header')
<!-- partial:partials/_sidebar.html -->
@include('admin.inc.sidebar')
<!-- partial -->

@include('admin.inc.navbar')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card-body">
                    <!-- body  -->

                    <h4 class="card-title">Update Products</h4>
                
                    <form class="forms-sample" action="{{url('/product_update', $product->id)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Product Title</label>
                            <input style="color:black" type="text" class="form-control" name="title"
                                id="exampleInputUsername1" value="{{$product->title}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Description</label>
                            <textarea style="color:black" name="description"
                             id="" cols="50" rows="5">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Old Image</label>
                            <img style="height: 100px; width:100px" src="productimage/{{$product->image}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Image</label>
                            <input style="color:black" type="file" class="form-control" name="image"
                                id="exampleInputUsername1">
                        </div>

                        <div class="form-group ">
                            <label for="exampleInputUsername1">Category</label>
                            <input style="color:black" type="text" value="{{$product->category}}" 
                            class="form-control" name="category">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Product quantity</label>
                            <input style="color:black" type="text" class="form-control" name="quantity"
                                value="{{$product->quantity}}" id="exampleInputUsername1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Product Price</label>
                            <input style="color:black" type="text" class="form-control" name="price"
                                value="{{$product->price}}" id="exampleInputUsername1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Price Discount</label>
                            <input style="color:black" type="text" class="form-control"
                                value="{{$product->price_discount}}" name="price_discount" id="exampleInputUsername1">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>
                    <!-- body -->

                </div>

            </div>
        </div>

    </div>
    <!-- container-scroller -->
    @include('admin.inc.footer')