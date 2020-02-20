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
            left: 27px;
            top: 1px;
            z-index: 9;
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
                        <img src="{{$user_avatar}}"
                             class="circle" alt="Profile image"
                             style="width:100px;height:100px;border: 1px solid #f7f7f7;">
                    </div>
                    <div class="mb-3 text-center profile-name">
                        <h5 class="text-muted">{{Auth::user()->username}}</h5>
                    </div>
                    <div><a href="{{url('clear-chat')}}" style="display: none;">clear</a></div>
                    @include('common.partials.flash-messages')
                    <div class="chat-thread-list">
                        @foreach($threads as $thread)
                        @if(!empty($thread->ad) && (is_countable($thread->messages) && count($thread->messages)>0 || $thread->id==$active_thread->id))
                                @php($thread_user = $thread->users->where('id', '!=', Auth::id())->first())
                            <div class="position-relative">
                                <a href="{{url('messages/thread', $thread->id)}}"
                                   class="thread thread-link-{{$thread->id}} {{$thread->id==$active_thread->id?"active":""}}"
                                   id="{{ $thread->id }}" data-id="{{ $thread->id }}">
                                    <div
                                        class="row chat-thread-tab thread-tab-{{$thread->id}} {{$thread->id==$active_thread->id?"active":""}}">

                                        <div class="col-md-3 p-0 float-left profile-icon text-center thread-icon"
                                             data-thread-id="{{$thread->id}}">
                                            @if(count($thread->get_unread)>0)
                                                <span data-thread-id="{{$thread->id}}"
                                                      class="badge badge-primary pending"
                                                      style="">{{count($thread->get_unread)}}</span>
                                            @endif
                                            <img src="{{asset('public/images/image-placeholder.jpg')}}"
                                                 class="profile-post-image" alt="">
                                            <img
                                                src="{{$thread_user->media!=null?asset(\App\Helpers\common::getMediaPath($thread_user->media)):asset('public/images/profile-placeholder.png')}}"
                                                class="profile-image" alt="Profile image" style="border: 1px solid #f7f7f7;">
                                        </div>
                                        <div class="col-md-9 p-0 mt-1 profile-name">
                                            <span class="font-weight-bold align-middle"
                                                  style="min-height: 1em;">{{$thread_user->first_name}} {{$thread_user->last_name}}</span>
                                            <p class="text-muted thread-ad-title mb-0">{{$thread->ad->getTitle()}}</p>
                                            <p class="text-muted mb-1 small">
                                                <span class="thread-time">{{!empty($thread->messages)&&is_countable($thread->messages)&&count($thread->messages)>0?$thread->messages->last()->created_at->format('d.m.Y'):""}}</span>
                                                <span>-</span>
                                                <span class="thread-message">{{!empty($thread->messages)&&is_countable($thread->messages)&&count($thread->messages)>0?$thread->messages->last()->message:""}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{url('messages/delete/'.$thread->id)}}" class="position-absolute text-muted thread-delete-button" style="top: 15px;right:0">
                                    <span class="fa fa-trash" style="font-size: 1.3em;"></span>
                                </a>
                            </div>
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
        var message_thread_id = 0;

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".thread.active").find('.pending').remove();
            message_thread_id = $(".thread.active").attr('id');
            $.ajax({
                type: "get",
                url: "{{url('messages/render-thread')}}/" + message_thread_id, // need to create this route
                cache: false,
                async: false,
                success: function (data) {
                    $('#thread-data').html(data);
                    scrollToBottomFunc();
                }
            });

            // $('.thread.active').first().trigger('click');
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('d4efdc4a073f0521f41e', {
                cluster: 'ap2',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                if(data.to_user_id == '{{Auth::id()}}'){
                    if($('.thread-link-' + data.thread_id).length<1){
                        var thread = '' +
                            '<a href="messages/thread/' + data.thread_id + '" class="thread thread-link-' + data.thread_id + '" id="' + data.thread_id + '" data-id="' + data.thread_id + '">\n' +
                            '    <div class="row chat-thread-tab thread-tab-' + data.thread_id + '">\n' +
                            '        <div class="col-md-3 p-0 float-left profile-icon text-center thread-icon" data-thread-id="' + data.thread_id + '">\n' +
                            '                <span  data-thread-id="' + data.thread_id + '" class="badge badge-primary pending"\n' +
                            '                      style="">1</span>\n' +
                            '            <img src="{{asset('public/images/image-placeholder.jpg')}}"\n' +
                            '                 class="profile-post-image" alt="">\n' +
                            '            <img src="public/images/profile-placeholder.png"\n' +
                            '                class="profile-image" alt="Profile image" style="">\n' +
                            '        </div>\n' +
                            '        <div class="col-md-9 p-0 mt-1 profile-name">\n' +
                            '            <span class="font-weight-bold align-middle" style="min-height: 1em;"></span>\n' +
                            '            <p class="text-muted thread-message">' + data.message + '</p>\n' +
                            '        </div>\n' +
                            '    </div>\n' +
                            '</a>\n';

                        $('.chat-thread-list').prepend(thread);
                    }
                    if (parseInt($('#current_thread').val()) == data.thread_id) {
                        var files = data.files;
                        var file_anchor = "";
                        for (var i=0; i<files.length; i++){
                            file_anchor += '<br><a href="'+files[i].path+'" target="_blank"><span class="fa fa-paperclip"></span> '+files[i].name+'</a>'
                        }

                        var str = '' +
                            '            <div class="message receiver-message">\n' +
                            '                <div class="profile-icon">\n' +
                            '                    <img src="' + $('#my_avatar').val() + '" class="circle"\n' +
                            '                         alt="Profile image" style="width:35px;">\n' +
                            '                </div>\n' +
                            '                <div class="message-text" style="min-height: 1em;">\n' +
                            '                    <span class="align-middle">' + data.message + '</span>\n' +
                            '                    ' + file_anchor + '\n' +
                            '                    <br>\n' +
                            '                    <span class="text-muted timeago" style="font-size: 0.7em" title="'+new Date($.now())+'"></span>\n' +
                            '                </div>\n' +
                            '            </div>\n' +
                            '            <div class="clearfix"></div>\n';
                        $('#conversation').append(str);
                        $(".timeago").timeago();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "get",
                            url: "{{url('messages/read_all')}}/"+data.thread_id
                        });
                        scrollToBottomFunc();
                    }
                    $('.thread-tab-' + data.thread_id + ' .thread-message').text(data.message);
                    if (!isEmpty($('.thread-link-' + data.thread_id))) {

                        // if receiver is not selected, add notification for that user
                        var pending = parseInt($('span[data-thread-id=' + data.thread_id + ']').html());

                        if (pending) {
                            $('span[data-thread-id=' + data.thread_id + ']').html(pending + 1);
                        } else {
                            $('.thread-icon[data-thread-id=' + data.thread_id + ']:not(.active .thread-icon[data-thread-id=' + data.thread_id + '])').append('' +
                                '<span data-thread_id="' + data.thread_id + '" class="badge badge-primary pending"\n' +
                                '>1</span>');
                        }
                    }
                }
            });

            $(document).on('keydown', '.message-input', function (e) {
                var message = $("#message-input").val();
                if ((e.keyCode == 13 || e.keyCode == 10) && message == '') {
                    alert('Meldingen kan ikke være tom!');
                    $("#message-input").focus();
                }
                if ((e.keyCode == 13 || e.keyCode == 10) && message != '') {
                    e.preventDefault();
                    send_message();
                    $(this).val('');
                    $("#message-input").focus();
                }

            });

            $(document).on('click', '#send_button', function (e) {
                e.preventDefault();
                var message = $("#message-input").val();
                send_message();
                $("#message-input").focus();
                $("#message-input").val('');
            })

        });

        function send_message() {
            var message = $("#message-input").val();
            var message_thread_id = $('#current_thread').val();
            var from_user_id = $('#from_user_id').val();
            var to_user_id = $('#to_user_id').val();
            var form = document.getElementById('attachment-form');
            var formdata = new FormData(form);
            $('#attachment').val('');
            formdata.append('message', message);
            formdata.append('message_thread_id', message_thread_id);
            formdata.append('from_user_id', from_user_id);
            formdata.append('to_user_id', to_user_id);
            formdata.append('form', form);

            $.ajax({
                type: "post",
                url: "{{url('message')}}", // need to create this post route
                processData: false,
                contentType: false,
                async:false,
                data:formdata,
                cache: false,
                success: function (data) {
                    data = JSON.parse(data);
                    var files = data.files;
                    var file_anchor = "";
                    for (var i=0; i<files.length; i++){
                        file_anchor += '<br><a href="'+files[i].path+'" target="_blank"><span class="fa fa-paperclip"></span> '+files[i].name+'</a>'
                    }
                    var str = '' +
                        '            <div class="message sender-message">\n' +
                        '                <div class="profile-icon">\n' +
                        '                    <img src="' + $('#my_avatar').val() + '" class="circle"\n' +
                        '                         alt="Profile image" style="width:35px;">\n' +
                        '                </div>\n' +
                        '                <div class="message-text" style="min-height: 1em;">\n' +
                        '                    <span class="align-middle">' + message + '</span>\n' +
                        '                    '+file_anchor+'\n' +
                        '                    <br>\n' +
                        '                    <span class="text-muted timeago" style="font-size: 0.7em" title="'+new Date($.now())+'"></span>\n' +
                        '                    <span class="msg-response"></span>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '            <div class="clearfix"></div>\n';
                    $('#conversation').append(str);
                    $(".timeago").timeago();
                    $('.thread-tab-' + message_thread_id + ' .thread-time').text(formate_date(new Date($.now())));
                    $('.thread-tab-' + message_thread_id + ' .thread-message').text(message);
                },
                error: function (jqXHR, status, err) {
                    alert('Melding sendte mislyktes!');
                },
                complete: function () {
                    scrollToBottomFunc();
                }
            });
            $('#attachment').val();
            $('#attachment-box').html('');


        }

        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('#conversation').animate({
                scrollTop: $('#conversation').get(0).scrollHeight
            }, 50);
        }

    </script>

@endsection
@section('script')
    <script src="{{asset('public/js/time-ago-in-words.min.js')}}"></script>
@endsection
