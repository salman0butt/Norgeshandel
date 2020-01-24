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
                    @if(!isset($filters) || empty($filters))
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
                <div class="hits fa-pull-right"><span class="font-weight-bold">36 331</span> treff på <span
                        class="font-weight-bold">{{count($jobs)}}</span> annonser
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4 pt-4">
                <!--                    <button class="dme-btn-outlined-blue">Lagre søk</button>-->
            </div>
            <div class="col-md-4 pt-4">
                <div class="pt-3 float-left" style="min-width: 53px;">
                    @if(isset($view) && $view=="list")
                        <a href="{{url('jobs/search?view=grid')}}" id="list_view"
                           class="change_view dme-btn-rounded-back-only">
                            <i class="fa fa-th"></i>
                        </a>
                    @else
                        <a href="{{url('jobs/search/?view=list')}}" id="grid_view"
                           class="change_view dme-btn-rounded-back-only">
                            <i class="fa fa-list"></i>
                        </a>
                    @endif
                </div>
                <div class="pt-3 float-left">
                    <a href="#" class="dme-btn-rounded-back-only"><i class="fa fa-map-marker"></i> <span class="">Vis på
                            kart</span></a>
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
{{--                    {{$jobs->links()}}--}}
                </div>
            </div>
        </div>

    {{-- search saved button start --}}

    <!-- Button trigger modal -->
        <button type="button" class="btn bg-maroon text-white" data-toggle="modal" data-target="#basicExampleModal"
                style="margin-top: -3%;position: absolute;z-index: 999;">
            Save Searches
        </button>
{{--        @include('common.partials.flash-messages)--}}
    <!-- Modal -->
        <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document" style="margin-top:10%">
                <div class="modal-content">
                    <form action="{{ url('/savedsearches') }}" name="save-search" method="POST">
                        {{csrf_field()}}
                        {{method_field('POST')}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Lagre søk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="modal__content">
                                <div>
                                    <h2 class="u-t3 u-strong">Lagre søk</h2>
                                </div>
                                <div>
                                    <div class="input input--text">
                                        <label>Navn
                                            <input placeholder="Navn på søk" name="name" size="30"
                                                   value="" required=""
                                                   class="form-control search-control">
                                        </label>
                                    </div>
                                    <div class="input-toggle">
                                        <input type="checkbox" id="notify" name="notify" checked="" value="1">
                                        <label for="notify">Ja takk, varsle meg om nye treff!</label>
                                    </div>
                                    <p>
                                        Du blir varslet på e-post, i appen på mobil og her på FINN.no
                                    </p>


                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-maroon text-white" data-dismiss="modal">Close
                            </button>
                            <input type="submit" Value="save changes" class="btn bg-maroon text-white">
                            <input type="hidden" id="recent-search" value="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- search saved button ends --}}
        <div class="row">
            @if(!is_countable($jobs) || count($jobs)<1)
                <div class="col-md-6 offset-md-3 mt-3">
                    <div class="alert alert-info">Ingen jobb funnet!</div>
                </div>
            @else
                @foreach($jobs as $job)
                    @if($job != null)
                        @if(isset($view) && $view == "list")
                            @include('user-panel.partials.templates.job-list')
                        @else
                            @include('user-panel.partials.templates.job-sequare')
                        @endif
                    @endif
                @endforeach
            @endif
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div style="float: right">
{{--                    {{$jobs->links()}}--}}
                </div>
            </div>
        </div>
    </div> <!--    ended container-->
    <div class="right-ad pull-right">
        <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
    </div>
