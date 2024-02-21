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

                @if(session()->has('message'))
                <div class="btn btn-success">
                    <button type="" class="close" data-dismiss="alert" area-hidden="true">
                        X
                    </button>
                    {{session()->get('message')}}
                </div>
                @endif
                <div class="card-body">
                    <!-- body  -->

                    <h4 class="card-title">Add Products</h4>
                    <form class="forms-sample" action="{{url('/add_products')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Product Title</label>
                            <input style="color:black" type="text" class="form-control" name="title"
                                id="exampleInputUsername1" placeholder="write your Product Title...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Description</label>
                            <textarea  style="color:black" name="description" id="" cols="50" rows="5"
                                placeholder="write your Description..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Image</label>
                            <input style="color:black" type="file" class="form-control" name="image"
                                id="exampleInputUsername1">
                        </div>

                        <div class="form-group ">
                            <label for="exampleInputUsername1">Category</label>
                            <select class="form-control form-control-sm" name="category" style="color:black; background:white;"
                                id="exampleFormControlSelect3">
                                @foreach($category as $category)
                                <option>{{$category->category_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Product quantity</label>
                            <input style="color:black" type="text" class="form-control" name="quantity"
                                id="exampleInputUsername1" placeholder="product  quantity...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Product Price</label>
                            <input style="color:black" type="text" class="form-control" name="price"
                                id="exampleInputUsername1" placeholder="product  price...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Price Discount</label>
                            <input style="color:black" type="text" class="form-control" name="price_discount"
                                id="exampleInputUsername1" placeholder="Discount price...">
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