<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/public">
    @include('home.inc.homestyle')
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.inc.header')
        <!-- end header section -->
        <!-- slider section -->
        <div class="container">
            <h1 style="margin-top:25px;font-size:30px; color:red;" class="card-title"><b>Order List</b></h1>
            <div class="row">
                @if(session()->has('message'))
                <div class="btn btn-success">
                    <button type="" class="close" data-dismiss="alert" area-hidden="true">
                        X
                    </button>
                    {{session()->get('message')}}
                </div>
                @endif
                <table class="table table-bordered table-contextual">
                    <thead>
                        <tr>
                            <th><b>Product title</b> </th>
                            <th><b>Price</b> </th>
                            <th><b>Quantity</b> </th>
                            <th><b>Image</b> </th>
                            <th><b>Payment Status</b> </th>
                            <th><b>Delivery Status</b> </th>
                            <th><b>Action</b> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $order)
                        <tr class="table-info">
                            <td> {{$order->product_title}} </td>
                            <td> {{$order->price}} </td>
                            <td> {{$order->quantity}} </td>
                            <td> <img style="height:50px; width:50px" src="productimage/{{$order->image}}" alt=""></td>
                            <td> {{$order->payment_status}} </td>
                            <td> {{$order->delevary_status}} </td>
                            <td>
                            @if($order->delevary_status=='Processing')  
                            <a class="badge badge-danger"
                                onclick="return confirm('Are you sure to cancel the order!')"
                                href="{{url('cancel_order',$order->id)}}">Cancel Order
                            </a> 
                            @else
                                <p>Not Allowed</p>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- end slider section -->
    </div>



    <!-- footer start -->
    @include('home.inc.footer')