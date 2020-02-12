@extends('layouts.landingSite')
@section('body_class', 'page-messages')
@section('page_content')
@php
    $user_avatar = Auth::user()->media!=null?asset(\App\Helpers\common::getMediaPath(Auth::user()->media)):asset('public/images/profile-placeholder.png');
@endphp

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

        .m-t-56 {
            margin-top: 56px;
        }

        .p-r {
            position: relative;
        }

        .p-t {
            top: 60px;
        }

        .m-t-8 {
            margin-top: 8px;
        }

        .m-t-5 {
            margin-top: 10px;
        }

    </style>
    <main class="smart-scroll">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 smart-scroll"
                     style="border-right: 1px solid #ecdfe2; height: calc(100vh - 50px); overflow-y: scroll; overflow-x: hidden">
                    <div class="mt-3 text-center profile-icon">
                        <img
                            src="{{$user_avatar}}"
                            class="" alt="Profile image"
                            style="width:80px;">
                    </div>
                    <div class="mb-3 text-center profile-name">
                        <h5 class="text-muted">{{Auth::user()->username}}</h5>
                    </div>
                    <div class="chat-thread-list">
                        @foreach($threads as $thread)
                            @if(!empty($thread->ad))
{{--                            <a href="#" class="user" id="{{ $thread->id }}">--}}
                            <a href="#" class="thread" id="{{ $thread->id }}" data-id="{{ $thread->id }}">
                                <div class="row chat-thread-tab">

                                    <div class="col-md-3 p-0 float-left profile-icon text-center">
{{--                                        @if($user->unread)--}}
{{--                                            <span class="badge badge-primary pending"--}}
{{--                                                  style="position: absolute;z-index: 99;left: 25px;">{{ $user->unread }}</span>--}}
{{--                                        @endif--}}
                                        <img src="{{asset('public/images/image-placeholder.jpg')}}"
                                             class="profile-post-image" alt="">
                                        <img src="{{$thread->user->media!=null?asset(\App\Helpers\common::getMediaPath($thread->user->media)):asset('public/images/profile-placeholder.png')}}"
                                            class="profile-image" alt="Profile image" style="">
                                    </div>
                                    <div class="col-md-9 p-0 mt-1 profile-name">
                                        <span class="font-weight-bold align-middle" style="min-height: 1em;">{{$thread->ad->getTitle()}}</span>
                                        <p class="text-muted">message</p>
                                    </div>
                                </div>
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8 smart-scroll"
                     style="height: calc(100vh - 50px); overflow-y: scroll; position: relative;" id="thread-data">

                </div>
            </div>
        </div>

    </main>
    <!-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script> -->
    <script>

        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";

        $(document).ready(function () {
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
            channel.bind('my-event', function (data) {
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
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


            $('.thread').click(function (e) {
                e.preventDefault();
                $('.thread').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();
                var thread_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "{{url('messages/render-thread')}}/"+thread_id, // need to create this route
                    cache: false,
                    success: function (data) {
                        $('#thread-data').html(data);
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
            $('.message-box').animate({
                scrollTop: $('.message-box').get(0).scrollHeight
            }, 50);
        }

    </script>

@endsection
