<?php
$logo='';
$gallery='';
if(isset($job)){
    $ad = \App\Models\Ad::find($job->ad_id);
    $job = $ad->job;
}
elseif(isset($ad)){
    $ad = \App\Models\Ad::find($ad->id);
    $job = $ad->job;
}
$media = $ad->media;
if($ad->company_gallery->count() > 0){
    $company_gallery = $ad->company_gallery->first();
    if($company_gallery){
        $gallery = \App\Helpers\common::getMediaPath($company_gallery);
    }
}


if ($job->company_id != 0) {
    if (is_countable($job->company->company_logo) && count($job->company->company_logo) > 0) {
        $logo = \App\Helpers\common::getMediaPath($job->company->company_logo->first());
    }
} else {
    if (is_countable($job->ad->company_logo) && count($job->ad->company_logo) > 0) {
        $logo = \App\Helpers\common::getMediaPath($job->ad->company_logo->first());
    }
}
//if(count($media)>0){
//        foreach ($media as $item){
//            if ($item->type=='logo'){
//                $logo = \App\Helpers\common::getMediaPath($item);
//            }
//        }
//    }
    ?>
<div class="col-md-4 product-list-mobile col-sm-6 pr-0 cgrid">
    <a href="{{url('jobs', compact('job'))}}" class="row product-list-item mr-1 p-sm-1" style="text-decoration: none;">
        <div class="image-section col-sm-12 px-2 pt-2">
            <div class="trailing-border" style="height: 302px; width:100%;
background-image: url('@if(!empty($logo)){{$logo}}@else{{asset('public/images/placeholder.png')}}@endif');
                    background-position: center; @if(!empty($logo)) background-repeat: no-repeat; background-size: 100%; @else background-size: cover;  @endif">
{{--                <img src="@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/placeholder.png')}}@endif" style="" alt="" class="img-fluid radius-8">--}}
                <div class="product-price"><img src="{{asset('public/images/Jobb_ikon_white.svg')}}" width="23px;"></div>
            </div>
        </div>
        <div class="detailed-section col-sm-12 px-2 pb-2">
            <div class="product-location text-muted mb-0 my-2 u-d1">{{$job->address ? Str::limit($job->address,25).', ': ''}}{{$job->zip_city ? Str::ucfirst(Str::lower($job->zip_city)) : ''}}</div>
            <div class="location u-t5 text-muted mt-2">{{$job->sector}}</div>
            <div class="title color-grey">{{Str::limit($job->name,80)}}</div>
            <div class="detail u-t5 mt-2 float-left text-muted">{{$job->emp_name}} <br>{{$job->positions}} stillinger</div>
            {{--<div class="dealer-logo float-right mt-3" ><img src="{{$logo}}" style="max-height: 40px;" alt="" class="img-fluid"></div>--}}
        </div>
    </a>
    @include('user-panel.partials.fav-heart-button', compact('ad'))
</div>
