<?php

use App\Helpers\common;

$job = \App\Models\Ad::find($ad->id)->job;
$empname = isset($job->company) && !empty($job->company)?$job->company->emp_name:$job->emp_name;

$image_path = 'public/images/image-placeholder.jpg';
if (isset($job->company)){
    if(is_countable($job->company->company_gallery) && count($job->company->company_gallery)>0){
        $image_path = common::getMediaPath($job->company->company_gallery->first(), '235x180');
    }
}
else{
    if(is_countable($job->company_gallery) && count($job->company_gallery)>0){
        $image_path = common::getMediaPath($job->company_gallery->first(), '235x180');
    }
}

?>
<div class="row product-list-item mr-1 p-sm-1 mt-3">
    <div class="image-section col-sm-4 p-2">
        <img src="{{asset($image_path)}}" alt="" class="img-fluid radius-8">
    </div>
    <div class="detailed-section col-sm-8 p-2">
        <div style="width:100%;">
            <div class="week-status u-t5 text-muted" style="">{{$job->title}}</div>
            <form action="{{route('jobs.destroy', compact('job'))}}" METHOD="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
            <button type="submit" class="link float-right" href="" style="cursor: pointer;"><span class="fa fa-trash-alt text-muted"></span></button>
            </form>
            <div class="location u-t5 text-muted mt-2">{{$job->address}}</div>
            <p class="detail u-t5 mt-3 text-muted">{{$job->headline}}<br>{{$empname}}</p>
        </div>
        <a href="" class="dme-btn-outlined-blue float-right">Flere valg</a>
        @if($ad->status=='saved')
            <a href="{{route('jobs.edit', compact('job'))}}" class="dme-btn-outlined-blue float-right mr-2">Fullfør annonsen</a>
        @endif
    </div>
</div>
