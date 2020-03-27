<?php
$logo='';
$gallery='';
if(isset($ad)){
    $ad = \App\Models\Ad::find($ad->id);
    $job =  $ad->job;
}
if(isset($job)){
    $job = \App\Admin\Jobs\Job::find($job->id);
    $ad = $job->ad;
}

//if(!isset($job)){
//    $job = $ad->job;
//}
//$job = \App\Admin\Jobs\Job::find($job->id);
$media = array();
if($job->ad && $job->ad->media){
    $media = $job->ad->media;
}
if(count($media)>0){
    foreach ($media as $item){
        if ($item->type=='logo'){
            $logo = \App\Helpers\common::getMediaPath($item, '66x66');
        }
        if ($item->type=='gallery'){
            $gallery = \App\Helpers\common::getMediaPath($item, '200x200');
        }
    }
}
?>
<div class="col-sm-12 pr-0 end_fav_item" data-name="{{$job->title}}">

    <a href="{{url('jobs', compact('job'))}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
        <div class="image-section col-sm-4  p-2">
            <div class="trailing-border">
                <img src="@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/placeholder.png')}}@endif" style="height:@if(Request()->get('view') && Request()->get('view') == 'list') 174.93px !important; @else 130px; @endif width: 100%" alt="" class="img-fluid radius-8">
                <div class="product-price"><img src="{{asset('public/images/Jobb_ikon_white.svg')}}" width="23px;"></div>
            </div>
        </div>
        <div class="detailed-section col-sm-8 p-2">
            <div class="location u-t5 text-muted mt-2">{{$job->sector}}</div>
            <div class="title color-grey">{{$job->title}}</div>
            <div class="detail u-t5 mt-2 float-left text-muted">{{$job->emp_name}} <br>{{$job->positions}} stillinger</div>
            <div class="dealer-logo float-right mt-3" ><img src="{{$logo}}" style="max-height: 40px;" alt="" class="img-fluid"></div>
        </div>
    </a>
    @include('user-panel.partials.fav-heart-button', compact('ad'))
</div>
