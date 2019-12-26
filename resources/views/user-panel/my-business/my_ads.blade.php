@extends('layouts.landingSite')
{{--{{dd($my_ads)}}--}}
<?php

$ads = array();
$published = 0;
$saved = 0;
$discontinued = 0;

$job_fulltime = 0;
$job_parttime = 0;
$job_management = 0;
foreach ($my_ads as $ad){
    if($ad->type=="job"){
        if($ad->job_type == "management"){
            $job_management++;
        }
        elseif($ad->job_type == "full_time"){
            $job_fulltime++;
        }
        elseif($ad->job_type == "part_time"){
            $job_parttime++;
        }
    }
    if($ad->status == 'published'){
        $published++;
    }
    elseif($ad->status == 'discontinued'){
        $discontinued++;
    }
    elseif($ad->status == 'saved'){
        array_push($ads, $ad);
        $saved++;
    }
}
?>
@section('page_content')
    <main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-12 mt-5 mb-5">
                    <h2 class="text-center text-muted">Mine annonser</h2>
                </div>
            </div>
        </div>
        <div class="dme-container mb-5">
            <div class="row">
                <aside class="col-md-3">
                    <div class="form-group">
                        <h3 class="u-t5">Status</h3>
                        <div class="pl-3 pr-3">
                            <label for="status" class="radio-lbl">Påbegynte annonser ({{$saved}})
                                <input type="radio" id="status" class="status" checked name="status" value="saved">
                                <span class="checkmark"></span>
                            </label>

                            <label for="status-1" class="radio-lbl">Aktive annonser ({{$published}})
                                <input type="radio" id="status-1" class="status" name="status" value="published">
                                <span class="checkmark"></span>
                            </label>

                            <label for="status-2" class="radio-lbl">Utgåtte annonser ({{$discontinued}})
                                <input type="radio" id="status-2" class="status" name="status" value="expired">
                                <span class="checkmark"></span>
                            </label>

                        </div>
                        <div class="form-group">
                            <h3 class="u-t5 mt-5">Annonsetyper</h3>
                            <div class="pl-3 pr-3">
                                <label for="ad-type" class="radio-lbl">Alle annonsetyper
                                    <input type="radio" checked="" id="ad-type" class="ad_type" name="ad_type" value="all-ads">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="ad-type-1" class="radio-lbl">Heltidsstilling
                                    <input type="radio" id="ad-type-1" class="ad_type" name="ad_type" value="job-full_time">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="ad-type-2" class="radio-lbl">Deltidsstilling
                                    <input type="radio" id="ad-type-2" class="ad_type" name="ad_type" value="job-part_time">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="ad-type-3" class="radio-lbl">Lederstilling
                                    <input type="radio" id="ad-type-3" class="ad_type" name="ad_type" value="job-management">
                                    <span class="checkmark"></span>
                                </label>

                            </div>
                        </div>
                    </div>
                </aside>
                <div class="col-md-9">

                    <div class="ads-list" id="ads-list">
                        {{--repeatation--}}
                        @foreach($ads as $ad)
                                @include('user-panel.partials.templates.job-saved')
                        @endforeach
                        @if(count($ads)<1)
                            <div class="row alert alert-warning">
                                <h3 class=" text-center col-md-12">Du har ingen annonser.</h3>
                                <h5 class=" text-center col-md-12">Dine andre annonser kan du finne ved å endre på filteret.</h5>
                            </div>
                        @endif
                        {{--end repeatation--}}
                    </div>
                </div>
            </div>
        </div>

    </main>
    <input type="hidden" value="{{url('jobs/search/filter_my_ads/')}}" id="url">
    <input type="hidden" value="{{asset('public/images/loader.png')}}" id="loader">
    <script>
        $(document).ready(function (e) {
            $('.status, .ad_type').change(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var status = $('input[name=status]:checked').val();
                var ad_type = $('input[name=ad_type]:checked').val();
                var url = $('#url').val();
                $.ajax({
                    url: url+'/'+status+'/'+ad_type,
                    type: "GET",
                    success: function (response) {
                        json_jobs = $.parseJSON(response);

                        if(json_jobs.length>0) {
                            $('#ads-list').html('');
                            var data = '';
                            for (var i = 0; i < json_jobs.length; i++) {
                                data += '<div class="row product-list-item mr-1 p-sm-1 mt-3">' +
                                    '<div class="image-section col-sm-4 p-2">' +
                                    '<img src="{{url('public/images/image-placeholder.jpg')}}" alt="" class="img-fluid radius-8">' +
                                    '</div>' +
                                    '<div class="detailed-section col-sm-8 p-2">' +
                                    '<div style="width:100%;">' +
                                    '<div class="week-status u-t5 text-muted" style="">Ukens bolig</div>' +
                                    '<a class="float-right" style="cursor: pointer;"><span class="fa fa-trash-alt text-muted"></span></a>' +
                                    '<div class="location u-t5 text-muted mt-2">Agnesodden 12B, Stavern</div>' +
                                    '<p class="detail u-t5 mt-3 text-muted">Eier (Selveier) • Tomannsbolig • 3 soverom <br>DNB Eiendom AS</p>' +
                                    '</div>' +
                                    '<a href="#" class="dme-btn-outlined-blue float-right">Flere valg</a>' +
                                    '<a href="#" class="dme-btn-outlined-blue float-right mr-2">Fullfør annonsen</a>' +
                                    '</div>' +
                                    '</div>';
                            }
                            $('#ads-list').html(data);
                        }
                        else{
                            $('#ads-list').html(
                                '<div class="row alert alert-warning">\n' +
                                '                                <h3 class=" text-center col-md-12">Du har ingen annonser.</h3>\n' +
                                '                                <h5 class=" text-center col-md-12">Dine andre annonser kan du finne ved å endre på filteret.</h5>\n' +
                                '</div>'
                                );
                        }

                    }
                });
            })
        });
    </script>
@endsection
