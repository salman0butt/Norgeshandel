@php
    $ad = $thread->ad;
    $this_user = Auth::user();
    $other_user = $thread->users->where('id', '!=', Auth::id())->first();
    //dd($ad);
    $my_avatar = $this_user->media!=null?asset(\App\Helpers\common::getMediaPath($this_user->media)):asset('public/images/profile-placeholder.png');
    $their_avatar = $other_user->media!=null?asset(\App\Helpers\common::getMediaPath($other_user->media)):asset('public/images/profile-placeholder.png');
    //$ad_avatar = $ad->media!=null?asset(\App\Helpers\common::getMediaPath($other_user->media)):asset('public/images/profile-placeholder.png');
@endphp
<div class="row">
    <div class="col-md-12 p-2 bg-maroon-lighter">
        <a href="#" class="">
            <div class="mr-3 float-left profile-icon text-center">
                <img src="{{$their_avatar}}" class="circle" alt="Profile image" style="width:60px;">
            </div>
            <div class="ml-3 mt-3 profile-name">
                <span class="font-weight-bold align-middle">{{$ad->getTitle()}}</span>
            </div>
        </a>
    </div>
</div>
<div class="row message-box" id="message-box"
     style="max-height: calc(100% - 176px);overflow-y: scroll;background-color: #fdfdfd;">
    <div class="col-md-12 conversation" id="conversation">
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
                    <img src="{{$message->sender==Auth::id()?$my_avatar:$their_avatar}}" class="circle"
                         alt="Profile image" style="width:35px;">
                </div>
                <div class="message-text" style="min-height: 1em;">
                    <span class="align-middle">{{ $message->message }}</span>
                    <br>
                    <span class="text-muted timeago" style="font-size: 0.7em" title="{{$message->created_at}}"></span>
                </div>
            </div>
            <div class="clearfix"></div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="send-message-box">
            <div class="row">
                <div class="col-md-10 text-center m-0 p-0">
                    <textarea class="form-control message-input" id="message-input" placeholder="Skriv meldingen din her..."></textarea>
                </div>
                <div class="col-md-1 bg-light-grey m-0 p-0 text-center">
                    <a href="#"><span class="fa fa-paperclip" style="font-size: 30px;padding: 15px"></span></a>
                </div>
                <div class="col-md-1 bg-maroon-lighter m-0 p-0 text-center">
                    <a href="#" id="send_button">
                        <span class="fa fa-paper-plane bg-maroon-lighter" style="font-size: 30px;padding: 15px"></span>
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
    })
</script>
