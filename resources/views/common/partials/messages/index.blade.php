@php
    $ad = $thread->ad;
    $this_user = Auth::user();
    $other_user = $thread->users->where('id', '!=', Auth::id())->first();
    //dd($ad);
    $my_avatar = $this_user->media!=null?asset(\App\Helpers\common::getMediaPath($this_user->media)):asset('public/images/profile-placeholder.png');
    $their_avatar = $other_user->media!=null?asset(\App\Helpers\common::getMediaPath($other_user->media)):asset('public/images/profile-placeholder.png');

@endphp
<div class="row">
    <div class="col-md-12 p-2 bg-maroon-lighter">
        <a href="{{url('profile/public/'.$other_user->id)}}" target="_blank" title="View profile" class="float-left">
            <div class="mr-3 float-left profile-icon text-center">
                {{--                <img src="{{$their_avatar}}" class="circle" alt="Profile image" style="width:60px;height:60px;">--}}
            </div>
            <div class="m-3 profile-name">
                <span
                    class="font-weight-bold align-middle">{{$other_user->first_name}} {{$other_user->last_name}}</span>
            </div>
        </a>
        <a href="{{url('/?handel='.$ad->id)}}" style="float: right;text-align: right">
            <div class="float-left m-2">
                <span>{{$ad->getTitle()}}</span>
                <br>
                <span class="text-muted">price</span></div>
            <img
                src="{{is_countable($ad->company_gallery)&&count($ad->company_gallery)>0?asset(\App\Helpers\common::getMediaPath($ad->company_gallery->first())):asset('public/images/placeholder.png')}}"
                class="profile-post-image m-2" alt="" style="max-width: 70px;max-height: 70px;">
        </a>
    </div>
</div>
<div class="row message-box" id="message-box"
     style="max-height: calc(100% - 185px);background-color: #fdfdfd;">
    <div class="col-md-12 position-relative" style="padding:0;">
        <div class="conversation position-absolute p-1"
             style="bottom: 0;width: 100%;overflow-y: scroll;max-height: 100%" id="conversation">
            @foreach($messages as $message)
                @php
                    if ($message->from_user_id==Auth::id()){
                        $class = "sender-message";
                    }
                    else{
                        $class = "receiver-message";
                    }
                @endphp
                <div class="message {{$class}}">
                    <div class="profile-icon">
                        <img src="{{$message->from_user_id==Auth::id()?$my_avatar:$their_avatar}}" class="circle"
                             alt="Profile image" style="width:35px;">
                    </div>
                    <div class="message-text" style="min-height: 1em;">
                        <span class="align-middle">{{ $message->message }}</span>
                        <br>
                    @if(is_countable($message->media) && count($message->media)>0)
                        @foreach($message->media as $file)
                                <a href="{{\App\Helpers\common::getMediaPath($file)}}" target="_blank"><span class="fa fa-paperclip"></span> {{$file->name}}</a>
                                <br>
                        @endforeach
                        @endif
                        <span class="text-muted timeago" style="font-size: 0.7em"
                              title="{{$message->created_at}}"></span>
                        <span class="msg-response"></span>
                    </div>
                </div>
                <div class="clearfix"></div>
            @endforeach
        </div>
        <div class="attachment-box position-absolute" id="attachment-box" style="bottom:0;max-width: 90%;"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="background-color: #fdfdfd">
        <div class="send-message-box" style="">
            <div class="row">
                <div class="col-md-10 text-center m-0 p-0">
                    <textarea class="form-control message-input" id="message-input"
                              placeholder="Skriv meldingen din her..."></textarea>
                </div>
                <div class="col-md-1 bg-light-grey m-0 p-0 text-center position-relative">
                    <form action="#" id="attachment-form" enctype="multipart/form-data">
                    <input type="file" multiple name="attachment[]" id="attachment" accept=".doc,.docx,.pdf,.txt,.jpg,.jpeg,.png"
                           style="width: 100%;height: 100%;opacity: 0;cursor: pointer;position: absolute;top: 0;z-index: 9;left: 0;">
                    <a href="#" style="display: block;width: 100%;height: 100%;cursor: pointer">
                        <span class="fa fa-paperclip" style="font-size: 30px;margin-top: 35px;"></span>
                    </a>
                    </form>
                </div>
                <div class="col-md-1 bg-maroon-lighter m-0 p-0 text-center">
                    <a href="#" id="send_button" style="display: block;width: 100%;height: 100%;">
                        <span class="fa fa-paper-plane" style="font-size: 30px;margin-top: 35px;"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="my_avatar" value="{{$my_avatar}}">
<input type="hidden" id="their_avatar" value="{{$their_avatar}}">
<input type="hidden" id="from_user_id" value="{{$this_user->id}}">
<input type="hidden" id="to_user_id" value="{{$other_user->id}}">
<input type="hidden" id="ad_id" value="{{$ad->id}}">
<input type="hidden" id="current_thread" value="{{$thread->id}}">

<!-- <div class="input-text">
    <input type="text" name="message" class="submit">
</div> -->
<script>
    $(document).ready(function () {
        $(".timeago").timeago();
        $(document).on('change', '#attachment', function () {
            $('#attachment-box').html('');
            if(this.files.length>0) {
                var clearbtn = '<div class="attached-file-clear-link">\n' +
                    '                <a href="#"><span class="fa fa-times"></span> Fjern vedlegg</a>\n' +
                    '            </div>';
                $.each(this.files, function (index, file) {
                    var filebox = '<div class="attached-file">\n' +
                        '    <span class="fa fa-paperclip"></span>\n' +
                        file.name +
                        '</div>\n';
                    $('#attachment-box').append(filebox);
                });
                $('#attachment-box').append(clearbtn);
            }
            $("#message-input").focus();
        });
        $(document).on('click', '.attached-file-clear-link', function (e) {
            $('#attachment-box').html('');
            $('#attachment').val('');
            $("#message-input").focus();
        })
    })
</script>
