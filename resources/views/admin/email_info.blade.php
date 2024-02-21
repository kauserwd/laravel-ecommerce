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

                        <h4 class="card-title">Sent Email to User</h4>
                        <form class="forms-sample" action="{{url('send_user_email', $order->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email Greeting</label>
                                <input style="color:black" type="text" class="form-control" name="greeting"
                                    id="exampleInputUsername1" placeholder="write First Line...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email First Line</label>
                                <input style="color:black" type="text" class="form-control" name="firstline"
                                    id="exampleInputUsername1" placeholder="write First Line...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email Body</label>
                                <textarea style="color:black" name="body" id="" cols="100" rows="10">Enter text here....</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email Bottom Name</label>
                                <input style="color:black" type="text" class="form-control" name="button"
                                    id="exampleInputUsername1" placeholder="write bootom email...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email Url</label>
                                <input style="color:black" type="text" class="form-control" name="url"
                                    id="exampleInputUsername1" placeholder="Enter Email Url...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email Last line</label>
                                <input style="color:black" type="text" class="form-control" name="lastline"
                                    id="exampleInputUsername1" placeholder="write Email Last line...">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Sent</button>
                        </form>
                        <!-- body -->

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    @include('admin.inc.footer')