<a href="#" style="position: initial" class="
                        add-to-fav
                        @if(Auth::check() && count($ad->favorite($ad->id))>0)
        fav
@else
        not-fav
@endif
        "
   @if(Auth::check() && count($ad->favorite($ad->id))<1)
   data-target="#modal_select_category"
   @endif
   @if(Auth::check())
   data-toggle="modal" data-id="{{$ad->id}}"
   @else
   data-toggle="modal" data-target="#modal_login"
        @endif
>
    <button style="font-size: 20px;" class="dme-btn-outlined-blue" title="Lagre som favoritt">
                        <span
                                @if(Auth::check() && count($ad->favorite($ad->id))>0)
                                class="fa fa-heart text-muted mr-2"
                                @else
                                class="far fa-heart text-muted mr-2"
                                @endif
                        ></span>
        Legg til favoritt
    </button>
</a>