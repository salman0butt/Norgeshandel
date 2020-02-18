<?php

use App\Helpers\common;
$empname = $job->company_id != 0 ? $job->company->emp_name : $job->emp_name;
//dump($job);

$image_path = 'public/images/image-placeholder.jpg';
if ($job->company_id != 0) {
    if (is_countable($job->company->company_gallery) && count($job->company->company_gallery) > 0) {
        $image_path = common::getMediaPath($job->company->company_gallery->first(), '235x180');
    }
} else {
    if (is_countable($job->ad->company_gallery) && count($job->ad->company_gallery) > 0) {
        $image_path = common::getMediaPath($job->ad->company_gallery->first(), '235x180');
    }
}

?>
<div class="row bg-hover-maroon-lighter radius-8 p-sm-1">
    <a href="{{route('jobs.show', compact('job'))}}" class="image-section col-sm-4 p-2">
        <img src="{{asset($image_path)}}" alt="" class="img-fluid radius-8">
    </a>
    <div class="detailed-section col-sm-8 p-2 position-relative">
        <a href="{{route('jobs.show', compact('job'))}}" style="width:100%; display: block">
            <div class="week-status u-t5 text-muted" style="">{{$job->title}}</div>
            <div class="location u-t5 text-muted mt-2">{{$job->address}}</div>
            <p class="detail u-t5 mt-3 text-muted">{{$job->headline}}<br>{{$empname}}</p>
        </a>
        <form action="{{route('jobs.destroy', compact('job'))}}" METHOD="POST" onsubmit="javascript:return confirm('Vil du slette denne annonsen?')">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="link" style="cursor: pointer;position: absolute;right: 0;top: 0"><span
                    class="fa fa-trash-alt text-muted"></span></button>
        </form>
        <div class="buttons position-absolute p-2" style="bottom: 0;right: 0">
            <a href="" class="dme-btn-outlined-blue float-right">Flere valg</a>
            @if($job->ad->status=='saved')
                <a href="{{route('jobs.edit', compact('job'))}}" class="dme-btn-outlined-blue float-right mr-2">Fullfør
                    annonsen</a>
            @endif
        </div>
    </div>
</div>
