<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/public">
    @include('home.inc.homestyle')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
                title: "Are you sure to cancel this product",
                text: "you will not be able to revert this!:",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
    }
    </script>

</head>

<body>
    @include('sweetalert::alert')
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.inc.header')
        <!-- end header section -->
        <!-- slider section -->
        <div class="container">
            <h1 style="margin-top:25px;font-size:30px; color:red;" class="card-title"><b>Cart List</b></h1>
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
                            <th><b>Product Title</b> </th>
                            <th><b>Product Quantity</b> </th>
                            <th><b>Product Price</b> </th>
                            <th><b>Product Image</b> </th>
                            <th><b>Action</b> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalprice=0; ?>
                        @foreach($cart as $cart)
                        <tr class="table-info">

                            <td> {{$cart->product_title}} </td>
                            <td> {{$cart->quantity}} </td>
                            <td> ${{$cart->price}} </td>

                            <td> <img style="height:100px; width:100px" src="productimage/{{$cart->image}}" alt=""></td>
                            <td>
                                <a class="badge badge-danger" onclick="confirmation(event)"
                                    href="{{url('cart_delete',$cart->id)}}">Delete</a>
                            </td>
                        </tr>
                        <?php $totalprice=$totalprice+$cart->price; ?>
                        @endforeach
                    </tbody>

                </table>
                <h1 style="margin-left:345px;font-weight:bold;font-size:30px; color:red">Total Price: ${{$totalprice}}
                </h1>
            </div>
            <div style="margin-left:342px; margin-top:20px; font-weight:bold;font-size:30px; color:green;">
                <h1>Proceed to Order</h1>
                <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delevary</a>
                <a href="{{url('stripe',$totalprice)}}" class="btn btn-danger">Pay Using Card</a>
            </div>

        </div>
    </div>

    <!-- end slider section -->
    </div>



    <!-- footer start -->
    @include('home.inc.footer')