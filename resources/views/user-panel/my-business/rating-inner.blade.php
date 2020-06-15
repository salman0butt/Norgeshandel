@if($ratings->count() > 0)
    @foreach($ratings as $key=>$rating)
        <div class="review-block p-3 col-12">
            <div class="row">
                <div class="col-sm-3">
                    <img src="@if($rating->from_user->media!=null){{asset(\App\Helpers\common::getMediaPath($rating->from_user->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif" alt="Profile image" class="img-rounded" style="width: 75px; border-radius: 50%">
                    <div class="review-block-name"><a href="#">{{($rating->from_user && $rating->from_user->username) ? $rating->from_user->username : 'NH-Bruker' }}</a></div>
                    <div class="review-block-date">{{$rating->created_at->format('d M Y')}}
                        <br><span class="u-stone timeago" title="{{$rating->created_at}}"></span>
                    </div>
                </div>

                <div class="col-sm-9">
                    <div class="review-block-rate">
                        <div class="rating-stars">
                            @for($i=1;$i<=5;$i++)
                                <span class="fa fa-star {{$i <= ($rating->general_ratings/2)  ? 'checked' : ''}}"></span>
                            @endfor
                        </div>
                    </div>
                    {{--<div class="review-block-title">Dette var fint å kjøpe</div>--}}
                    <div class="review-block-description">
                        {{$rating->review}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@if($ratings->total() > 5)
    @php
        if($ratings->count() > 0){
            $ratings_size = sizeof($ratings) -1;
            $last_id = $ratings[$ratings_size]->id;
        } else {
            $last_id = 0;
        }
    @endphp
    <div class="col-3 m-auto">
        <button class="dme-btn-outlined-blue mb-3 btn-sm show_more_notifications" data-last_id="{{$last_id}}" data-view_title="{{'rating-inner'}}"  data-user_id="{{Auth::id()}}" data-action="{{route('show-more-ratings')}}">
            <img src="{{asset('public/images/loader.gif')}}" style="width: 25px" class="d-none">
            vis flere vurderinger
        </button>
    </div>
@endif
