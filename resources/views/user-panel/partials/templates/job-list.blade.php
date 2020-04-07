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
    }
    if ($job && $job->ad && $job->ad->company_gallery && $job->ad->company_gallery->first()){
        $gallery = \App\Helpers\common::getMediaPath($job->ad->company_gallery->first(), '200x200');
    }
}
?>
<div class="col-sm-12 pr-0 end_fav_item" data-name="{{$job->title}}">

    <a href="{{url('jobs', compact('job'))}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
        <div class="image-section @if(Request::is('my-business/favorite-list/*')) col-sm-3 @else col-sm-4 @endif  p-2">
            <div class="trailing-border" style="height:{{(Request()->get('view') && Request()->get('view') == 'list')? '174.93px !important;':'130px;'}}; width: 100%;
                background-image: url('@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/placeholder.png')}}@endif'); background-size: cover; background-position: center;">
{{--                <img src="@if(!empty($gallery)){{$gallery}}@else{{asset('public/images/placeholder.png')}}@endif" style="" alt="" class="img-fluid radius-8">--}}
                <div class="product-price"><img src="{{asset('public/images/Jobb_ikon_white.svg')}}" width="23px;"></div>
            </div>
        </div>
        <div class="detailed-section @if(Request::is('my-business/favorite-list/*')) col-md-9 @else col-md-8 @endif p-2">
            <div class="product-location text-muted mb-0 mt-2 u-d1" style="font-size: 16px; color: #6c757d!important;">{{$job->address ? Str::limit($job->address,30).', ' : ''}}{{$job->zip_city ? Str::ucfirst(Str::lower($job->zip_city)) : ''}}</div>
            <div class="location u-t5 text-muted mt-2 float-left">{{$job->sector}}</div>
            <div class="clearfix"></div>
            <div class="title color-grey">{{$job->title}}</div>
            <div class="detail u-t5 mt-1 float-left text-muted">{{$job->emp_name}} <br>{{$job->positions}} stillinger</div>
            <div class="dealer-logo float-right mt-1" ><img src="{{$logo}}" style="max-height: 40px;" alt="" class="img-fluid"></div>
        </div>
    </a>
    @if(Request::is('my-business/favorite-list/*'))
        {{--<a class="btn btn-info btn-sm plus_note_button" data-toggle="collapse" data-target="#note_{{$job->ad ? $job->ad->id : ''}}"><i class="fa fa-plus mr-2"></i>Skriv notat til deg selv</a>--}}
        {{--<div id="note_{{$job->ad ? $job->ad->id : ''}}" class="collapse" style="background-color: #fff5cb; border-radius:10px">--}}
            {{--<form class="p-3">--}}
                {{--<textarea class="form-control bg-transparent border-0"></textarea>--}}
                {{--<div class="float-right">--}}
                    {{--<a class="btn btn-warning btn-sm close_button" data-toggle="collapse" data-target="#note_{{$job->ad ? $job->ad->id : ''}}">Lagre</a>--}}
                    {{--<input type="submit" value="Avbryt" class="btn btn-success btn-sm">--}}
                {{--</div>--}}
                {{--<div class="clearfix"></div>--}}
            {{--</form>--}}
        {{--</div>--}}

        {{--<p class="product-location text-muted mb-0 mt-2 u-d1" style="position: absolute;bottom: 15px;left: 231px;">--}}
            {{--{{$fav_item && $fav_item->note ? Str::limit($fav_item->note,60) : ''}}--}}
        {{--</p>--}}
        {{--<a href="#" data-id="{{$fav_item && $fav_item->id ? $fav_item->id : ''}}" data-target="#ad_note_for_fav" data-toggle="modal" class="ad_note_link" style="position: absolute;right: 25px;bottom: 15px;"><span class="fa fa-pencil"></span></a>--}}
    @endif
    @include('user-panel.partials.fav-heart-button', compact('ad'))
</div>
