@if($ratings->count() > 0)
    @foreach($ratings as $rating)
        <div class="p-3 bg-maroon-lighter radius-8 mb-4">
            <div class="row px-3">
                <div class="pr-2">
                    <div class="numberCircle">{{$rating->general_ratings}}</div>
                </div>
                <div class="pl-2">
                    <h5 class="mb-0">{{($rating->from_user && $rating->from_user->username) ? $rating->from_user->username : 'NH-Bruker' }}</h5>
                    <p class="font-weight-bold mb-0">{{$rating->created_at->format('d-m-Y')}}</p>
                    {{--<p>kjøper</p>--}}
                </div>
                <p>
                    {{$rating->review}}
                </p>
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
    <div class="float-right">
        <button class="dme-btn-outlined-blue btn-sm show_more_notifications" data-last_id="{{$last_id}}" data-user_id="{{$user->id}}" data-view_title="{{'public-user-rating-inner'}}" data-action="{{route('show-more-ratings')}}">
            <img src="{{asset('public/images/loader.gif')}}" style="width: 25px" class="d-none">
            vis flere vurderinger
        </button>
    </div>
@endif

