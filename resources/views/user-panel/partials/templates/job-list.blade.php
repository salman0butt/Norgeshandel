<?php
$logo='';
$gallery='';
if(!isset($job)){
    $job = $ad->job;
}

$media = $job->media;
if(count($media)>0){
    foreach ($media as $item){
        if ($item->type=='company_logo'){
            $logo = \App\Helpers\common::getMediaPath($item, '66x66');
        }
        if ($item->type=='company_gallery'){
            $gallery = \App\Helpers\common::getMediaPath($item, '200x200');
        }
    }
}
?>

<div style="position: relative" data-name="{{$job->title}}" class="favorite-list-item">
<a href="{{url('jobs', compact('job'))}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
    <div class="image-section col-sm-4  p-2">
        <div class="trailing-border">
            <img src="@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/image-placeholder.jpg')}}@endif" style="min-height: 125px;" alt="" class="img-fluid radius-8 mt-3 mb-3">
        </div>
    </div>
    <div class="detailed-section col-sm-8 p-2">
        <!--                                        <div class="week-status u-t5 text-muted" style="">Strandvegen, 2380 Brumunddal</div>-->
        <div class="location u-t5 text-muted mt-2">{{$job->sector}}</div>
        <div class="title color-grey">{{$job->title}}</div>
        <div class="detail u-t5 mt-2 float-left text-muted">{{$job->emp_name}} <br>{{$job->positions}} stillinger</div>
    </div>
</a>
    <a href="#" class="add-to-fav fav" data-id="{{$ad->id}}" style="position: absolute;top: 10px;">
        <span class="fa-heart text-muted fa"></span>
    </a>
</div>
