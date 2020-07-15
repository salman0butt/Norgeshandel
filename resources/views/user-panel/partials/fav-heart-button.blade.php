<a href="#" class="add-to-fav @if(Auth::check() && count($ad->favorite($ad->id))>0) fav @else not-fav @endif"
   @if(Auth::check() && count($ad->favorite($ad->id))<1)
    {{--data-target="#modal_select_category"--}}
    @endif
    @if(Auth::check())
    data-toggle="modal" data-id="{{$ad->id}}"
    @else
    data-toggle="modal" data-target="#modal_login" data-id="{{$ad->id}}"
    @endif
    >
    <span
        @if(Auth::check() && count($ad->favorite($ad->id))>0)
            class="fa fa-heart text-muted"
        @else
            class="far fa-heart text-muted"
        @endif
    ></span>
</a>