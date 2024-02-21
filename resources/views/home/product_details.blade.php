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
        <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; with:50% padding:30px;">
            <div class="img-box" style="padding:20px;">
                <img src="productimage/{{$product->image}}" alt="">
            </div>
            <div class="detail-box">
                <h5>
                    {{$product->title}}
                </h5>
                @if($product->price_discount!=null)
                <h6 style="color: red">
                    Discount Price : ${{$product->price_discount}}
                </h6>

                <h6 style="text-decoration: line-through; color: blue ">
                    Price : ${{$product->price}}
                </h6>
                @else
                <h6>
                    Price : ${{$product->price}}
                </h6>
                @endif

                <h6>
                    Product Category : {{$product->category}}
                </h6>
                <h6>
                    Product description : {{$product->description}}
                </h6>
                <h6>
                    Product Quantity : {{$product->quantity}}
                </h6>
            </div>
            <form action="{{url('add_to_cart', $product->id)}}" method="post">
                @csrf
                <div class="row" style="margin-top:10px">
                    <div class="col-md-4">
                        <input type="number" name="quantity" value="1" min="1">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Add to Cart">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- end slider section -->
    </div>



    <!-- footer start -->
    @include('home.inc.footer')