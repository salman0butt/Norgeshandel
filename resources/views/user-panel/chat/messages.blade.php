    @extends('layouts.landingSite')
    @section('page_content')

    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 508px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }

        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
        .m-t-56{
            margin-top:56px;
        }
        .p-r{
            position: relative;
        }
        .p-t{
            top: 60px;
        }
        .m-t-8{
            margin-top:8px;
        }
        .m-t-5{
            margin-top:10px;
        }

    </style>


        <main class="smart-scroll">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 smart-scroll"
                    style="border-right: 1px solid #ecdfe2; height: calc(100vh - 50px); overflow-y: scroll; overflow-x: hidden">
                    <div class="mt-3 text-center profile-icon">
                        <img src="@if(Auth::user()->media!=null){{asset(\App\Helpers\common::getMediaPath(Auth::user()->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif" class="" alt="Profile image"
                            style="width:80px;">
                    </div>
                    <div class="mb-3 text-center profile-name">
                        <h5 class="text-muted">{{Auth::user()->username}}</h5>
                    </div>
                    <div class="chat-thread-list">
                        @foreach($users as $user)
                            <a href="#" class="user"  id="{{ $user->id }}">
                                <div class="row chat-thread-tab">

                                    <div class="col-md-3 p-0 float-left profile-icon text-center">
                                        @if($user->unread)
                                            <span class="badge badge-primary pending" style="position: absolute;z-index: 99;left: 25px;">{{ $user->unread }}</span>
                                        @endif

                                        <img src="{{asset('public/images/image-placeholder.jpg')}}" class="profile-post-image" alt="">
                                        <img src="@if(App\Media::where('mediable_id',$user->id)->first() != null){{asset(\App\Helpers\common::getMediaPath(App\Media::where('mediable_id',$user->id)->first()))}}@else {{asset('public/images/profile-1.jpg')}} @endif" class="profile-image" alt="Profile image"
                                            style="">
                                    </div>
                                    <div class="col-md-9 p-0 mt-1 profile-name">
                                        <span class="font-weight-bold align-middle">{{$user->username}}</span>
                                        <p class="text-muted">{{$user->email}}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8 smart-scroll" style="height: calc(100vh - 50px); overflow-y: scroll; position: relative;">
                    <!-- <div class="row p-2 bg-maroon-lighter">
                        <div class="col-md-12">
                            <a href="#" class="">
                                <div class="mr-3 float-left profile-icon text-center">
                                    <img src="{{asset('public/images/profile-2.jpg')}}" class="circle" alt="Profile image"
                                        style="width:60px;">
                                </div>
                                <div class="ml-3 mt-3 profile-name">
                                    <span class="font-weight-bold align-middle">Judy Williams</span>
                                </div>
                            </a>
                        </div>
                    </div> -->
                    <div class="row message-box" style=";background-color:#fdfdfd;height: calc(100vh - 188px);">
                        <div class="col-md-12 conversation" style="" id="messages">


                        </div>
                    </div>

                </div>
            </div>
        </div>

        </main>



    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper m-t-56">
                    <ul class="users">
                        @foreach($users as $user)
                            <li class="user p-r"  id="{{ $user->id }}">
                                @if($user->unread)
                                    <span class="pending">{{ $user->unread }}</span>
                                @endif
                                <div class="media">
                                    <div class="media-left">
                                        <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                    </div>
                                    <div class="media-body">
                                        <p class="name">{{$user->username}}</p>
                                        <p class="email">{{$user->email}}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8 m-t-56" id="messages">


            </div>
        </div>
    </div> -->
    <!-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script> -->
    <script>

        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('d4efdc4a073f0521f41e', {
                cluster: 'ap2',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                if (my_id == data.from) {
                    $('#' + data.to).click();
                }
                else if (my_id == data.to)
                {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());

                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });


            $('.user').click(function (e)
            {
                e.preventDefault();
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();
                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
            });

            $(document).on('keyup', '.message-input', function (e) {
                var message = $(this).val();
                console.log(message);

                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty

                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {

                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                }
            });

        });

         // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }

    </script>

    @endsection
