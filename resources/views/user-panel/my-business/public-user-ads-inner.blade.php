@foreach($active_ads as $ad)
    <?php $ad = \App\Models\Ad::find($ad->id);?>
    @if($ad && $ad->visibility)
        @if($ad->ad_type == 'job')
            @include('user-panel.partials.templates.job-list')
        @else
            @include('user-panel.partials.templates.property-list')
        @endif
    @endif
@endforeach

@if($active_ads->total() > 20)
    @php
        if($active_ads->count() > 0){
            $active_ads_size = sizeof($active_ads) -1;
            $last_id = $active_ads[$active_ads_size]->id;
        } else {
            $last_id = 0;
        }
    @endphp
    <div class="text-center">
        <button class="dme-btn-outlined-blue mb-3 btn-sm show_more_public_profile_ads" data-last_id="{{$last_id}}" data-user_id="{{$user->id}}" data-action="{{route('show-more-public-profile-ads')}}">
            <img src="{{asset('public/images/loader.gif')}}" style="width: 25px" class="d-none">
            Vis flere annonser
        </button>
    </div>
@endif