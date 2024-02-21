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
                <div class="card">
                    @if(session()->has('message'))
                    <div class="btn btn-success">
                        <button type="" class="close" data-dismiss="alert" area-hidden="true">
                            X
                        </button>
                        {{session()->get('message')}}
                    </div>
                    @endif
                </div>
            </div>
            <br>
            <h4 style="margin-left:25px;" class="card-title">Product List</h4>
            <br>
            <table class="table table-bordered table-contextual">
                <thead>
                    <tr>
                        <th> # </th>
                        <th><b>Product Title</b> </th>
                        <th><b>Description</b> </th>
                        <th><b>Product Quantity</b> </th>
                        <th><b>Price Discount</b> </th>
                        <th><b>Product Price</b> </th>
                        <th><b>Category</b> </th>
                        <th><b>Product Image</b> </th>
                        <th><b>Update/Delet</b> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $product)
                    <tr class="table-info">
                        <td> {{$product->id}} </td>
                        <td> {{$product->title}} </td>
                        <td> {{$product->description}} </td>
                        <td> {{$product->quantity}} </td>
                        <td> {{$product->price}} </td>
                        <td> {{$product->price_discount}} </td>
                        <td> {{$product->category}} </td>
                        
                        
                        <td> <img src="productimage/{{$product->image}}" alt=""></td>
                        <td> 
                        <a class="badge badge-success" href="{{url('product_show',$product->id)}}">Update</a>   
                        <a class="badge badge-danger" onclick="return confirm('Are you sure to delete Category?')" href="{{url('product_delete',$product->id)}}">Delete</a>   
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- container-scroller -->
    @include('admin.inc.footer')