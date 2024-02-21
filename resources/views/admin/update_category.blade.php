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
                    <div class="card-body">
                        <!-- body  -->

                        <h4 class="card-title">Update Category</h4>
                        <form class="forms-sample" action="{{url('/Update_category', $data->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Category Name</label>
                                <input type="text" class="form-control" style="color:black" name="category_name" id="exampleInputUsername1"
                                    value="{{$data->category_name}}">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                        <!-- body -->

                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- container-scroller -->
    @include('admin.inc.footer')