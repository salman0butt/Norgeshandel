@php
    $ad = $thread->ad;
    $user = $thread->user;
    //dd($ad);
    if ($ad->user->id==Auth()->id()){ //it mean i'm ad
        $my_avatar = $ad->user->media!=null?asset(\App\Helpers\common::getMediaPath($ad->user->media)):asset('public/images/profile-placeholder.png');
        $their_avatar = $user->media!=null?asset(\App\Helpers\common::getMediaPath($user->media)):asset('public/images/profile-placeholder.png');
    }
    else{ //it mean i'm user
        $my_avatar = $user->media!=null?asset(\App\Helpers\common::getMediaPath($user->media)):asset('public/images/profile-placeholder.png');
        $their_avatar = $ad->user->media!=null?asset(\App\Helpers\common::getMediaPath($ad->user->media)):asset('public/images/profile-placeholder.png');
    }
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
<div class="row message-box" id="message-box" style="max-height: calc(100% - 176px);overflow-y: scroll;background-color: #fdfdfd;">
    <div class="col-md-12 conversation">
        @foreach($messages as $message)
            <div class="message {{$message->sender==Auth::id()?"sender-message":"receiver-message"}}">
                <div class="profile-icon">
                    <img src="{{$message->sender==Auth::id()?$my_avatar:$their_avatar}}" class="circle"
                         alt="Profile image" style="width:35px;">
                </div>
                <div class="message-text" style="min-height: 1em;">
                    <span class="align-middle">{{ $message->message }}</span>
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
                    <textarea class="form-control message-input" placeholder="Skriv meldingen din her..."></textarea>
                </div>
                <div class="col-md-1 bg-light-grey m-0 p-0 text-center">
                    <a href="#"><span class="fa fa-paperclip" style="font-size: 30px;padding: 15px"></span></a>
                </div>
                <div class="col-md-1 bg-maroon-lighter m-0 p-0 text-center">
                    <a href="#"><span class="fa fa-paper-plane bg-maroon-lighter"
                                      style="font-size: 30px;padding: 15px"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="input-text">
    <input type="text" name="message" class="submit">
</div> -->
