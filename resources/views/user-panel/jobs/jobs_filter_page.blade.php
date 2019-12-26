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
                <div class="hits fa-pull-right"><span class="font-weight-bold">36 331</span> treff på <span class="font-weight-bold">{{count($ads)}}</span> annonser</div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4 pt-4">
                <!--                    <button class="dme-btn-outlined-blue">Lagre søk</button>-->
            </div>
            <div class="col-md-4 pt-4">
                <div class="pt-3 float-left" style="min-width: 53px;">
                    <a href="?list" class="dme-btn-rounded-back-only"><i class="fa fa-list"></i></a>
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
        <div class="row">
                @foreach($ads as $ad)
                <?php $job = $ad->job_filtered($filters); ?>
                <?php $job = $job->first();?>
                    @if($job != null)
                        @include('user-panel.partials.templates.job-sequare')
                    @endif
                @endforeach
                <div class="row">
                    {{--<div class="col-sm-4 pr-0">--}}
                        {{--<a href="#" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">--}}
                            {{--<div class="image-section col-sm-12  p-2">--}}
                                {{--<div class="trailing-border">--}}
                                    {{--<img src="assets/images/job-company-logo.png" alt="" class="img-fluid radius-8 mt-3 mb-3">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="detailed-section col-sm-12 p-2">--}}
                                {{--<!--                                        <div class="week-status u-t5 text-muted" style="">Strandvegen, 2380 Brumunddal</div>-->--}}
                                {{--<div class="u-t5 text-muted" style="">&nbsp;</div>--}}
                                {{--<div class="location u-t5 text-muted mt-2">Ny i dag | Stjørdal</div>--}}
                                {{--<div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div>--}}
                                {{--<div class="title color-grey">Reservoir Geolog - Stjørdal</div>--}}
                                {{--<!--                                        <div class="mt-2">-->--}}
                                {{--<!--                                            <div class="area font-weight-bold float-left color-grey">&nbsp;</div>-->--}}
                                {{--<!--                                            <div class="price font-weight-bold float-right color-grey">12 000 000 kr</div>-->--}}
                                {{--<!--                                        </div>-->--}}
                                {{--<!--                                        <br>-->--}}
                                {{--<div class="detail u-t5 mt-2 float-left text-muted">Experis AS <br>2 stillinger</div>--}}
                                {{--<!--                                        <div class="dealer-logo float-right mt-3" ><img src="assets/images/businessplots-logo.png" alt="" class="img-fluid"></div>-->--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                </div>
        </div>
    </div>    <!--    ended container-->
    <div class="right-ad pull-right">
        <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
    </div>
</main>
@endsection