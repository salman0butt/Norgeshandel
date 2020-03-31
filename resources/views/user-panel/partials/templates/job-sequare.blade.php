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
if(count($media)>0){
        foreach ($media as $item){
            if ($item->type=='logo'){
                $logo = \App\Helpers\common::getMediaPath($item, '200x200');
            }
        }
    }
    ?>
<div class="col-sm-4 pr-0">

    <a href="{{url('jobs', compact('job'))}}" class="row product-list-item mr-1 p-sm-1" style="text-decoration: none;">
        <div class="image-section col-sm-12  p-2">
            <div class="trailing-border" style="height: 302px; width:100%;
background-image: url('@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/placeholder.png')}}@endif');
background-size: cover; background-position: center">
{{--                <img src="@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/placeholder.png')}}@endif" style="" alt="" class="img-fluid radius-8">--}}
                <div class="product-price"><img src="{{asset('public/images/Jobb_ikon_white.svg')}}" width="23px;"></div>
            </div>
        </div>
        <div class="detailed-section col-sm-12 p-2">
            <div class="location u-t5 text-muted mt-2 float-left">{{$job->sector}}</div>
            <div class="location u-t5 text-muted mt-2 float-right">{{$job->zip_city}}</div>
            <div class="clearfix"></div>
            <div class="title color-grey">{{$job->title}}</div>
            <div class="detail u-t5 mt-2 float-left text-muted">{{$job->emp_name}} <br>{{$job->positions}} stillinger</div>
            <div class="dealer-logo float-right mt-3" ><img src="{{$logo}}" style="max-height: 40px;" alt="" class="img-fluid"></div>
        </div>
    </a>
    @include('user-panel.partials.fav-heart-button', compact('ad'))
</div>
