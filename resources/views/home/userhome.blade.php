<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    @include('home.inc.homestyle')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    function reply(caller) {
        document.getElementById('commentId').value = $(caller).attr('data_commentId');
        $('.replyDiv').insertAfter($(caller));
        $('.replyDiv').show();
    }

    function reply_close(caller) {
        $('.replyDiv').hide();
    }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
</head>

<body>
@include('sweetalert::alert')
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.inc.header')
        <!-- end header section -->
        <!-- slider section -->
        @include('home.inc.slider')
        <!-- end slider section -->
    </div>
    <!-- why section -->
    @include('home.why')
    <!-- end why section -->

    <!-- arrival section -->
    @include('home.arival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('home.product')
    <!-- end product section -->
    <div class="col-sm-6 col-md-4 col-lg-4" Style="margin:auto">
        <div Style="margin-top:40px">
            <h2>
                <span Style="margin-top:40px; paddin 20px; font-weight:bold; color:red; font-size:25px;">Write Your
                    Comments
                    Here</span>
            </h2>
            <form class="forms-sample" action="{{url('add_comment')}}" method="POST">
                @csrf

                <div class="form-group">
                    <textarea style="color:black" name="comment" id="" style="height:100px; width:100px"></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="Comment">
            </form>
        </div>
        <div>
            <h1 Style="margin-top:40px; paddin 20px; font-weight:bold; color:red; font-size:25px;">All Comments</h1>
        </div>

        @foreach($comment as $comment)
        <div>
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <a href="javascript:void(0)" onclick="reply(this)" data_commentId="{{$comment->id}}" style="font-weight:bold; 
            fontsize20px; color:green;">Reply</a><br>
            <div style="padding-left:7%;padding-bottom:10px;">
                @foreach($reply as $rep)
                    @if($rep->comment_id==$comment->id)
                    <b><br>{{$rep->name}}</b>
                    <p>{{$rep->reply}}</p>
                    <a href="javascript:void(0)" onclick="reply(this)" data_commentId="{{$comment->id}}" style="font-weight:bold; 
                    fontsize20px; color:green;">Reply</a>
                    @endif
                @endforeach
            </div>
        </div>
        @endforeach

        <div Style="display:none" class="replyDiv">
            <form class="forms-sample" action="{{url('add_reply')}}" method="POST">
                @csrf
                <input type="text" id="commentId" name="commentId" hidden="">
                <textarea style="height:100px; width:500px" name="reply" id=""></textarea><br>
                <button type="submit" class="btn btn-primary">Reply</button>
                <a href="javascript:void(0)" class="btn" onClick="reply_close(this)">Close</a>
            </form>
        </div>
    </div>

    <!-- subscribe section -->
    @include('home.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('home.client')
    <!-- end client section -->
    <!-- footer start -->
    @include('home.inc.footer')