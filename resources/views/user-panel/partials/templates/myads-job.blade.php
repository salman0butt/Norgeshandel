<?php

use App\Helpers\common;
$empname = $job->company_id != 0 ? $job->company->emp_name : $job->emp_name;
//dump($job);

$image_path = '';
if ($job->company_id != 0) {
    if (is_countable($job->company->company_logo) && count($job->company->company_logo) > 0) {
        $image_path = common::getMediaPath($job->company->company_logo->first(),'150x150');
    }
} else {
    if (is_countable($job->ad->company_logo) && count($job->ad->company_logo) > 0) {
        $image_path = common::getMediaPath($job->ad->company_logo->first(),'150x150');
    }
}

?>
<div class="row bg-hover-maroon-lighter radius-8 p-sm-1">
    <a href="{{route('jobs.show', compact('job'))}}" class="image-section col-sm-4 p-2">
        <div class="img-fluid radius-8 trailing-border" style="height: 160px; width:100%;
                background-image: url('@if(!empty($image_path)){{$image_path}}@else{{asset('public/images/placeholder.png')}}@endif');
                background-position: center; @if(!empty($image_path)) background-repeat: no-repeat; @else background-size: cover;  @endif">
        </div>
        {{--        <img src="{{asset($image_path)}}" alt="" class="img-fluid radius-8" style="height: 160px; width: 100%;">--}}
        @if($job && $job->ad && !$job->ad->visibility)
            <span class="badge badge-primary" style="position: absolute;top: 16px;right: 16px;">skjult</span>
        @endif

        @if($job && $job->ad->status == 'deactivate' && $job->ad->ad_type == 'job')
            <span class="badge badge-warning" style="position: absolute;top: 16px;left: 16px;">
                Fristen utløpt
            </span>
        @endif
    </a>
    <div class="detailed-section col-sm-8 p-2 position-relative">
        <a href="{{route('jobs.show', compact('job'))}}" style="width:100%; display: block">
            <div class="week-status u-t5 text-muted" style="">{{$job->name}}</div>
            @if($job->address)
                <div class="location u-t5 py-1 text-muted mt-2">{{$job->address ? $job->address.', ' : ''}}{{$job->zip_city ? Str::ucfirst(Str::lower($job->zip_city)) : ''}}</div>
            @endif
            <p class="detail u-t5 text-muted">{{$job->headline}}<br>{{$empname}}</p>
        </a>
        <form action="{{route('jobs.destroy', compact('job'))}}" METHOD="POST" onsubmit="javascript:return confirm('Vil du slette denne annonsen?')">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="link" style="cursor: pointer;position: absolute;right: 0;top: 0"><span
                    class="fa fa-trash text-muted"></span></button>
        </form>
        <a href="{{route('jobs.edit', compact('job'))}}" style="color:#ac304a !important; padding: 4px !important;" class="dme-btn-outlined-blue mr-2 btn-sm edit-ad-button">
            @if($job->ad->status == 'saved') Fullfør annonsen @else Endre @endif
        </a>
        <a style="color:#ac304a !important; padding: 4px !important;" href="{{route('jobs.show', compact('job'))}}" class="dme-btn-outlined-blue mr-2 btn-sm">Se annonse</a>
        @if($job->ad->status != 'saved')
        <a style="color:#ac304a !important; padding: 4px !important;" href="{{url('my-business/my-ads/'.$job->ad->id.'/statistics')}}" class="dme-btn-outlined-blue mr-2 btn-sm statistics-button">Se statistikk</a>
        @endif
        <a style="color:#ac304a !important; padding: 4px !important;" href="{{url('my-business/my-ads/'.$job->ad->id.'/options')}}" class="dme-btn-outlined-blue mr-2 btn-sm">Flere valg</a>

        @if($job->ad && $job->ad->expiry && $job->ad->expiry->date_start && $job->ad->expiry->date_end)
            <div class="pt-3">
                <h5>
                    <span class="badge badge-success">Påbegynt: {{date("d-m-Y", strtotime($job->ad->expiry->date_start))}}</span>
                    <span class="badge badge-warning pl-3">Utløper: {{date("d-m-Y", strtotime($job->ad->expiry->date_end))}}</span>
                </h5>
            </div>
        @endif

        <?php /*
        <div class="buttons position-absolute p-2" style="bottom: 0;right: 0">
            <a href="{{url('user/ads/options')}}" class="dme-btn-outlined-blue float-right">Flere valg1</a>
            @if($job->ad->status=='saved')
                <a href="{{route('jobs.edit', compact('job'))}}" class="dme-btn-outlined-blue float-right mr-2">Fullfør
                    annonsen</a>
            @endif
        </div> */ ?>
    </div>
</div>
