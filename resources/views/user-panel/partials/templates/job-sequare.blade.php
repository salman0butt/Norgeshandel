<?php
$logo='';
$gallery='';
if(isset($ad)){$ad = \App\Models\Ad::find($ad->id);}
if(isset($job)){$job = \App\Admin\Jobs\Job::find($job->id);}
if(!isset($job)){
    $job = $ad->job;
}
if (!isset($ad)){$ad=$job->ad;}
$job = \App\Admin\Jobs\Job::find($job->id);
$ad = $job->ad;
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
<div class="col-sm-4 pr-0">

    <a href="{{url('jobs', compact('job'))}}" class="row product-list-item mr-1 p-sm-1" style="text-decoration: none;">
        <div class="image-section col-sm-12  p-2">
            <div class="trailing-border">
                <img src="@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/image-placeholder.jpg')}}@endif" style="height: 302px; width:100%;" alt="" class="img-fluid radius-8">
                <div class="product-price"><img src="{{asset('public/images/Jobb_ikon_white.svg')}}" width="23px;"></div>
            </div>
        </div>
        <div class="detailed-section col-sm-12 p-2">
            <div class="location u-t5 text-muted mt-2">{{$job->sector}}</div>
            <div class="title color-grey">{{$job->title}}</div>
            <div class="detail u-t5 mt-2 float-left text-muted">{{$job->emp_name}} <br>{{$job->positions}} stillinger</div>
            <div class="dealer-logo float-right mt-3" ><img src="{{$logo}}" style="max-height: 40px;" alt="" class="img-fluid"></div>
        </div>
    </a>
    @include('user-panel.partials.fav-heart-button', compact('ad'))
</div>
