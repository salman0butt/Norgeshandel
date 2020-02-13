<div class="left-ad float-left">
    <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
</div>
<div class="dme-container pl-3 pr-3">
    <div class="row top-ad">
        <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
    </div>
    <div class="row mt-4">
        <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
            <h2 class="u-t2 p-2 job-type">
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
                    <a href="{{url('jobs/search?view=grid')}}" data-name="grid" id="view"
                       class="change_view dme-btn-rounded-back-only">
                        <i class="fa fa-th"></i>
                    </a>
                @else
                    <a href="{{url('jobs/search/?view=list')}}" data-name="list" id="view"
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
                <label for="sort" class="mb-1">Sortér på</label>
                <select name="sort" id="sort" class="dme-form-control">
                    <option value="0" @if(isset($sort) && $sort=="0") selected @endif>Mest relevant</option>
                    <option value="1" @if(isset($sort) && $sort=="1") selected @endif>Publisert</option>
                    <option value="2" @if(isset($sort) && $sort=="2") selected @endif>Arbeidsgiver</option>
                    <option value="3" @if(isset($sort) && $sort=="3") selected @endif>Sted</option>
                    <option value="4" @if(isset($sort) && $sort=="4") selected @endif>Nærmest</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div style="float: right">
{{--                                    {{$jobs->links()}}--}}
            </div>
        </div>
    </div>

{{-- search saved button start --}}

<!-- Button trigger modal -->
    <button type="button" id="save_search_dialog_btn" class="btn bg-maroon text-white" data-toggle="modal" data-target="#basicExampleModal"
            style="margin-top: -3%;position: absolute;z-index: 999;">
        Lagrede søk
    </button>
{{--        @include('common.partials.flash-messages)--}}
<!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-top:10%">
            <div class="modal-content">
                <form action="{{ url('/savedsearches') }}" id="save_search" name="save-search" method="POST">
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
                                    <input type="hidden" name="filter" id="filter">
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
                        <button type="button" class="btn bg-maroon text-white" data-dismiss="modal">Lukk
                        </button>
                        <input type="submit" Value="Lagre endringer" class="btn bg-maroon text-white">
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
{{--                                    {{$jobs->links()}}--}}
            </div>
        </div>
    </div>
</div> <!--    ended container-->
<div class="right-ad pull-right">
    <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
</div>
    <?php
    $counts = array();
    $job_function = $jobs->groupBy('job_function')->map(function ($cc) {
        return $cc->count();
    })->toArray();
    $industry = $jobs->groupBy('industry')->map(function ($cc) {
        return $cc->count();
    })->toArray();
    $country = $jobs->groupBy('country')->map(function ($cc) {
        return $cc->count();
    })->toArray();
    $commitment_type = $jobs->groupBy('commitment_type')->map(function ($cc) {
        return $cc->count();
    })->toArray();
    $job_type = $jobs->groupBy('job_type')->map(function ($cc) {
        return $cc->count();
    })->toArray();
    $sector = $jobs->groupBy('sector')->map(function ($cc) {
        return $cc->count();
    })->toArray();
    $leadership_category = $jobs->groupBy('leadership_category')->map(function ($cc) {
        return $cc->count();
    })->toArray();
    $deadline = $jobs->groupBy('deadline')->map(function ($cc) {
        return $cc->count();
    })->toArray();
    $created_at = $jobs->groupBy('created_at')->map(function ($cc) {
        return $cc->count();
    })->toArray();

    foreach($created_at as $key=>$value){
        $created_at[date('Y-m-d', strtotime($key))] = $value;
        unset($created_at[$key]);
    }

    $counts = array_merge($counts, ["job_function" => $job_function]);
    $counts = array_merge($counts, ["industry" => $industry]);
    $counts = array_merge($counts, ["country" => $country]);
    $counts = array_merge($counts, ["commitment_type" => $commitment_type]);
    $counts = array_merge($counts, ["job_type" => $job_type]);
    $counts = array_merge($counts, ["sector" => $sector]);
    $counts = array_merge($counts, ["deadline" => $job_type]);
    $counts = array_merge($counts, ["created_at" => $created_at]);
    $counts = array_merge($counts, ["leadership_category" => $leadership_category]);
    $var = json_encode($counts);
    ?>
<script>
    function GetURLParameter(url, pName)
    {
        var string = url.split('?');
        if (string.length>0){
            var sURLVariables = string[1].split('&');
            if(sURLVariables.length>0) {
                for (var i = 0; i < sURLVariables.length; i++) {
                    var sParameterName = sURLVariables[i].split('=');
                    if(sParameterName[0] == pName) {
                        return sParameterName[1];
                    }
                }
            }
        }
    }
    $(document).ready(function () {
        var urlParams = new URLSearchParams(location.search);

        $('#save_search').submit(function () {
            var param = urlParams;
            param.delete('page');
            $('#filter').val("jobs/search?"+param.toString());
        });

        var param = urlParams;
        param.delete('page');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('checksearch')}}',
            data: {filter: "jobs/search?"+param.toString()},
            type: "GET",
            success: function (response) {
                if (response){
                    $('#save_search_dialog_btn').attr('disabled', "disabled");
                }
            },
            error: function (error) {
                // console.log(error);
            }
        });



        $.each($('.pagination .page-link'), function () {
            var link = $(this).attr('href');
            if(!isEmpty(link)) {
                var urlParams = new URLSearchParams(location.search);
                urlParams.delete('page');
                urlParams.set('page', GetURLParameter(link, 'page'));
                $(this).attr('href', "?"+urlParams.toString());
            }
        });
        var x = "{{$var}}";
        var counts = JSON.parse(x.replace(/&quot;/g, '\"'));
        var d = new Date();
        $('span.count').html('(0)');
        $('span.count').parent().parent().css("opacity", '1');
        $.each(counts, function (title, options) {
            $.each(options, function (option, counts) {
                if(!isEmpty(option)){
                    $('span.count[data-name="'+option+'"][data-title="'+title+'"]').html('('+counts+')');
                }
            });
        });
        $.each($('span.count'), function (i) {
            if($(this).html()=="(0)"){
                $(this).parent().parent().css("opacity", '0.5');
            }
        });
    });
</script>
