<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <br><br>
            <div>
                <form action="{{url('product_search')}}" method="get">
                    <input style="width:300px" type="text" name="search" placeholder="Search products here....">
                    <input type="submit" value="search">
                </form>
            </div>
        </div>
        <div class="row">
            @foreach($product as $products)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{url('product_details_view', $products->id)}}" class="option1">
                                Product Details
                            </a>
                            <form action="{{url('add_to_cart', $products->id)}}" method="post">
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
                    <div class="img-box">
                        <img src="productimage/{{$products->image}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{$products->title}}
                        </h5>
                        @if($products->price_discount!=null)
                        <h6 style="color: red">
                            ${{$products->price_discount}}
                        </h6>

                        <h6 style="text-decoration: line-through; color: blue ">
                            ${{$products->price}}
                        </h6>
                        @else
                        <h6>
                            ${{$products->price}}
                        </h6>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>

        


        <!-- <div class="btn-box">
            <a href="">
                View All products
            </a>
        </div> -->
    </div>
</section>