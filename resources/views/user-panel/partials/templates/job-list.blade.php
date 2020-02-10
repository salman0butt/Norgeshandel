<?php
$logo='';
$gallery='';
if(isset($ad)){$ad = \App\Models\Ad::find($ad->id);}
if(isset($job)){$ad = \App\Admin\Jobs\Job::find($job->id);}
if(!isset($job)){
    $job = $ad->job;
}
$job = \App\Admin\Jobs\Job::find($job->id);
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
<div class="col-sm-12 pr-0">

    <a href="{{url('jobs', compact('job'))}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
        <div class="image-section col-sm-4  p-2">
            <div class="trailing-border">
                <img src="@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/image-placeholder.jpg')}}@endif" style="max-height: 200px;" alt="" class="img-fluid radius-8">
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
    <a href="#" class="
    add-to-fav
    @if(Auth::check() && count($job->ad->favorite($job->ad->id))>0)
        fav
    @else
        not-fav
    @endif
                "
               @if(Auth::check() && count($job->ad->favorite($job->ad->id))<1)
                       data-target="#modal_select_category"
               @endif
                       @if(Auth::check())
                       data-toggle="modal" data-id="{{$job->ad->id}}"
               @else
                       data-toggle="modal" data-target="#modal_login"
                @endif
        >
        <span
                @if(Auth::check() && count($job->ad->favorite($job->ad->id))>0)
                class="fa fa-heart text-muted"
                @else
                class="far fa-heart text-muted"
                @endif
        ></span>
    </a>
</div>
