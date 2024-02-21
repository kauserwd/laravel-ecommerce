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
                        <button type="button" class="close" data-dismiss="alert" area-hidden="true">
                            X
                        </button>
                        {{session()->get('message')}}
                    </div>
                    @endif
                </div>
            </div>
            <br>
            <h4 style="margin-left:25px;" class="card-title">All Order List</h4>
            <br>
            <div style="margin:auto; padding-bottom:30px">
                <form action="{{url('search')}}" method="get">
                    @csrf
                    <input type="text" style="color:black" name="search" placeholder="Search for somethings...">
                    <input type="submit" value="search" class="btn btn-primary">
                </form>
            </div>
            <table class="table table-bordered table-contextual">
                <thead>
                    <tr>
                        <th><b>Name</b> </th>
                        <th><b>Email</b> </th>
                        <th><b>Phone</b> </th>
                        <th><b>Address</b> </th>

                        <th><b>Product title</b> </th>
                        <th><b>Price</b> </th>
                        <th><b>Quantity</b> </th>
                        <th><b>Image</b> </th>
                        <th><b>Payment Status</b> </th>
                        <th><b>Delivery Status</b> </th>
                        <th><b>Action</b> </th>
                        <th><b>Print Pdf</b> </th>
                        <th><b>Send Email</b> </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order as $order)
                    <tr class="table-info">
                        <td> {{$order->name}} </td>
                        <td> {{$order->email}} </td>
                        <td> {{$order->phone}} </td>
                        <td> {{$order->address}} </td>
                        <td> {{$order->product_title}} </td>
                        <td> {{$order->price}} </td>
                        <td> {{$order->quantity}} </td>
                        <td> <img src="productimage/{{$order->image}}" alt=""></td>
                        <td> {{$order->payment_status}} </td>
                        <td> {{$order->delevary_status}} </td>
                        <td>
                            @if($order->delevary_status=='Processing')
                            <a class="badge badge-success" onclick="return confirm('Are you sure to delete Category?')"
                                href="{{url('delevered',$order->id)}}">Delevered</a>
                            @else

                            <p>Delevered</p>

                            @endif
                        </td>
                        <td>  
                            <a href="{{url('print_pdf',$order->id)}}" class="btn btn-danger" >
                                Print PDF</i>
                            </a>
                        </td>
                        <td>  
                            <a href="{{url('send_email',$order->id)}}" class="badge badge-primary" >
                                Send Email</i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr class="table-info">
                        <td colspan="16">No Data Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- container-scroller -->
    @include('admin.inc.footer')