 <div class="row pl-4 pr4">

     @if(isset($ad->job) && $ad->job->workplace_video)
             <a data-fslightbox="gallery1" href="{{$job->workplace_video}}" class="dme-btn-outlined-blue mr-2" style="color: #ac304a; background: white; font-size: 20px; height: 50px">
                 <i class="far fa-play-circle fa-lg pr-1"></i>Video</a>
     @endif

<a href="#" style="position: initial" class="add-to-fav-btn
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
     <div id="shareRoundIcons" class="ml-4"></div>
                    </div>