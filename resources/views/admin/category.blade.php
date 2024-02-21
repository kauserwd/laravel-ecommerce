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

                        <h4 class="card-title">Add Category</h4>
                        <form class="forms-sample" action="{{url('/add_category')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Category Name</label>
                                <input style="color:black" type="text" class="form-control" name="category_name" id="exampleInputUsername1"
                                    placeholder="write your category name...">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                        <!-- body -->

                    </div>

                </div>
            </div>
            <br>
            <h4 style="margin-left:25px;" class="card-title">Category List</h4>
            <br>
            <table class="table table-bordered table-contextual">
                <thead>
                    <tr>
                        <th> # </th>
                        <th><b>Category Name</b> </th>
                        <th><b>Update/Delet</b> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $category)
                    <tr class="table-info">
                        <td> {{$category->id}} </td>
                        <td> {{$category->category_name}} </td>
                        <td> 
                        <a class="badge badge-success" href="{{url('cat_show',$category->id)}}">Update</a>   
                        <a class="badge badge-danger" onclick="return confirm('Are you sure to delete Category?')" href="{{url('cat_delete',$category->id)}}">Delete</a>   
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- container-scroller -->
    @include('admin.inc.footer')