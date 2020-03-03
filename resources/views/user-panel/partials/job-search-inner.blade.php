<style>
    #suggestions > div > div.col-md-6 > ul {
        margin-bottom: 0;
    }
</style>

{{--@dd(count($job_fulltime));--}}
<div class="row m-2 search-result-topic" style="margin-bottom: 0 !important;">
    <div class="col-md-3 p1 offset-1">
        @if (count($job_parttime) > 0 || count($job_fulltime) > 0 || count($job_management) >0)
            Jobs
        @endif
    </div>
    <div class="col-md-7">
        <ul class="p-1 list-unstyled">
            @if (count($job_parttime)> 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=part_time')}}">På deltid
                        ({{count($job_parttime)}})</a></li>
            @endif
            @if(count($job_fulltime) > 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=full_time')}}">På heltid
                        ({{count($job_fulltime)}})</a></li>
            @endif
            @if(count($job_management) > 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=management')}}">På ledelse
                        ({{count($job_management)}})</a></li>
            @endif
        </ul>
    </div>
</div>
<div class="row go-to-job-search-page">
    <div class="col-md-10 offset-md-1 p-2">
        <a href="{{url('jobs/search?search='.$search)}}" id="job-searches-page">
            <div class="float-left">
                <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" height="32" width="32">
                    <path fill="currentColor" fill-rule="evenodd" d="M22.412
                    21.198l-.558.656-.656.558a10.449 10.449 0 0 1-6.754 2.476C8.685
                    24.888 4 20.203 4 14.444 4 8.685 8.685 4 14.444 4c5.759 0 10.445
                    4.685 10.445 10.444 0 2.473-.88 4.872-2.477 6.754zm1.524
                    1.294a12.393 12.393 0 0 0 2.953-8.048C26.889 7.571 21.317 2 14.444 2
                    7.572 2 2 7.571 2 14.444c0 6.873 5.572 12.444 12.444 12.444 3.069 0
                    5.878-1.11 8.048-2.952L28.556 30 30 28.555l-6.064-6.063z">
                    </path>
                </svg>
            </div>
            <div class="pt-1">
                flere resultater for
            </div>
        </a>
    </div>
</div>
