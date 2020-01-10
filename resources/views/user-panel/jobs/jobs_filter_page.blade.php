@extends('layouts.landingSite')
@section('page_content')
<main class="dme-wrepper">
    <div class="left-ad float-left">
        <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
    </div>
    <div class="dme-container pl-3 pr-3">
        <div class="row top-ad">
            <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
        </div>
        <div class="row mt-4">
            <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
                <h2 class="u-t2 p-2">
                    @if(!isset($filters['job_type']))
                        Alle stillinger
                    @elseif(isset($filters['job_type']) && $filters['job_type']=='management')
                        Lederstilling
                    @elseif(isset($filters['job_type']) && $filters['job_type']=='full_time')
                        Heltidsstilling
                    @elseif(isset($filters['job_type']) && $filters['job_type']=='part_time')
                        Deltidsstilling
                    @endif
                </h2>
            </div>
            <div class="col-md-12">
                <div class="hits fa-pull-right"><span class="font-weight-bold">36 331</span> treff på <span class="font-weight-bold">{{count($jobs)}}</span> annonser</div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4 pt-4">
                <!--                    <button class="dme-btn-outlined-blue">Lagre søk</button>-->
            </div>
            <div class="col-md-4 pt-4">
                <div class="pt-3 float-left" style="min-width: 53px;">
                    @if(isset($view) && $view=="list")
                        <a href="{{url('jobs/search?view=grid')}}" id="list_view" class="change_view dme-btn-rounded-back-only">
                            <i class="fa fa-th"></i>
                        </a>
                    @else
                        <a href="{{url('jobs/search/?view=list')}}" id="grid_view" class="change_view dme-btn-rounded-back-only">
                            <i class="fa fa-list"></i>
                        </a>
                    @endif
                </div>
                <div class="pt-3 float-left">
                    <a href="#" class="dme-btn-rounded-back-only"><i class="fa fa-map-marker"></i> <span class="">Vis på kart</span></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="">
                    <label for="sort-by" class="mb-1">Sortér på</label>
                    <select name="sort-by" id="sort-by" class="dme-form-control">
                        <option value="0">Mest relevant</option>
                        <option value="1" selected="">Publisert</option>
                        <option value="2">Prisant lav-høy</option>
                        <option value="3">Prisant høy-lav</option>
                        <option value="4">P-ROM Areal lav-høy</option>
                        <option value="5">P-ROM Areal høy-lav</option>
                        <option value="6">Tot pris lav-høy</option>
                        <option value="7">Tot pris høy-lav</option>
                        <option value="8">Kvmeterpris lav-høy</option>
                        <option value="9">Kvmeterpris høy-lav</option>
                        <option value="99">Nærmest</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div style="float: right">
                    {{$jobs->links()}}
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($jobs as $job)
                @if($job != null)
                    @if(isset($view) && $view == "list")
                        @include('user-panel.partials.templates.job-list')
                    @else
                        @include('user-panel.partials.templates.job-sequare')
                    @endif
                @endif
            @endforeach
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div style="float: right">
                    {{$jobs->links()}}
                </div>
            </div>
        </div>
    </div>    <!--    ended container-->
    <div class="right-ad pull-right">
        <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
    </div>
</main>
<script>
    $(document).ready(function () {
        var urlParams = new URLSearchParams(location.search);
        $.each($('.pagination .page-link'), function () {
            var val = $(this).attr('href');
           $(this).attr('href', val+'&job_type='+urlParams.get('job_type')+'&view='+urlParams.get('view'));
        });
        $.each($('.change_view'), function () {
            var val = $(this).attr('href');
           $(this).attr('href', val+'&job_type='+urlParams.get('job_type')+'&page='+urlParams.get('page'));
        });
    })
</script>
@endsection
