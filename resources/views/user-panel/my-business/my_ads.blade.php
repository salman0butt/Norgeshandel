@extends('layouts.landingSite')
{{--{{dd($my_ads)}}--}}
<?php
use App\Models\Ad;
$published = Ad::where('status','published')->where('user_id',Auth::user()->id)->count();
$saved = Ad::where('status','saved')->where('user_id',Auth::user()->id)->count();
$discontinued = Ad::where('user_id',Auth::user()->id)->where('status','<>','published')->Where('status','<>','saved')->count();

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
}
?>
@section('page_content')
<style>
    .pagination {
        margin-top:10px;
        text-align:right;
        float:right;
    }
</style>
    <main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-12 mt-5 mb-5">
                    <h2 class="text-center text-muted">Mine annonser</h2>
                </div>
            </div>
        </div>
        <div class="dme-container mb-5">
            @include('common.partials.flash-messages')
            <div class="row">
             
                <aside class="col-md-3" id="my_ads_sidebar">
                    <div class="form-group">
                        <h3 class="u-t5">Status</h3>
                        <div class="pl-3 pr-3">
                            <label for="status" class="radio-lbl">Påbegynte annonser ({{$saved}})
                                <input type="radio" id="status" class="status" name="status" value="saved">
                                <span class="checkmark"></span>
                            </label>

                            <label for="status-1" class="radio-lbl">Aktive annonser ({{$published}})
                                <input type="radio" id="status-1" checked class="status" name="status" value="published">
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
                                <label for="ad-type" class="radio-lbl">Alle annonsetyper <span class="total_ads">({{$all_ads_count}})</span>
                                    <input type="radio" checked="" id="ad-type" class="ad_type" name="ad_type" value="all_ads">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="ad-type-1" class="radio-lbl">Heltidsstilling <span class="full_time_job">({{$full_time_job}})</span>
                                    <input type="radio" id="ad-type-1" class="ad_type" name="ad_type" value="jobs-full_time">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="ad-type-2" class="radio-lbl">Deltidsstilling <span class="part_time_job">({{$part_time_job}})</span>
                                    <input type="radio" id="ad-type-2" class="ad_type" name="ad_type" value="jobs-part_time">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="ad-type-3" class="radio-lbl">Lederstilling <span class="management_job">({{$management_job}})</span>
                                    <input type="radio" id="ad-type-3" class="ad_type" name="ad_type" value="jobs-management">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="property-property_for_rent" class="radio-lbl">Bolig til leie <span class="property_for_rent">({{$property_for_rent}})</span>
                                    <input type="radio" id="property-property_for_rent" class="ad_type" name="ad_type" value="property-property_for_rent">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="property-property_for_sales" class="radio-lbl">Bolig til salgs <span class="property_for_sale">({{$property_for_sale}})</span>
                                    <input type="radio" id="property-property_for_sales" class="ad_type" name="ad_type" value="property-property_for_sales">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="property-property_holidays_homes_for_sales" class="radio-lbl">Fritidsbolig til salgs <span class="property_holiday_home_for_sale">({{$holiday_home_for_sale}})</span>
                                    <input type="radio" id="property-property_holidays_homes_for_sales" class="ad_type" name="ad_type" value="property-property_holidays_homes_for_sales">
                                    <span class="checkmark"></span>
                                </label>

                                {{--                                <label for="ad-type-3" class="radio-lbl">Lederstilling--}}
                                {{--                                    <input type="radio" id="ad-type-3" class="ad_type" name="ad_type" value="property-realestate_business_plot">--}}
                                {{--                                    <span class="checkmark"></span>--}}
                                {{--                                </label>--}}

                                {{--                                <label for="ad-type-3" class="radio-lbl">Lederstilling--}}
                                {{--                                    <input type="radio" id="ad-type-3" class="ad_type" name="ad_type" value="property-commercial_plot">--}}
                                {{--                                    <span class="checkmark"></span>--}}
                                {{--                                </label>--}}

                                <label for="property-business_for_sales" class="radio-lbl">Bedrifter til salgs <span class="property_business_for_sale">({{$property_business_for_sale}})</span>
                                    <input type="radio" id="property-business_for_sales" class="ad_type" name="ad_type" value="property-business_for_sales">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="property-commercial_property_for_rents" class="radio-lbl">Næringseiendom til leie <span class="property_commercial_for_rent">({{$property_commercial_for_rent}})</span>
                                    <input type="radio" id="property-commercial_property_for_rents" class="ad_type" name="ad_type" value="property-commercial_property_for_rents">
                                    <span class="checkmark"></span>
                                </label>

                                <label for="property-commercial_property_for_sales" class="radio-lbl">Næringseiendom til salgs <span class="property_commercial_for_sale">({{$property_commercial_for_sale}})</span>
                                    <input type="radio" id="property-commercial_property_for_sales" class="ad_type" name="ad_type" value="property-commercial_property_for_sales">
                                    <span class="checkmark"></span>
                                </label>

                            </div>
                        </div>
                    </div>
                </aside>
                <div class="col-md-9">
                    <div class="my-ads-list" id="ads-list">
                        @if($my_ads->count() > 0)
                            @foreach($my_ads as $key=>$ad)
                                @if($ad->ad_type=='job' && $ad->job)
                                    <?php $job = $ad->job; ?>
                                    @include('user-panel.partials.templates.myads-job', compact('job'))
                                @endif
                                @if($ad->ad_type !='job' && $ad->property)
                                    <?php $property = $ad->property; ?>
                                    @include('user-panel.partials.templates.myads-property', compact('property'))
                                @endif
                            @endforeach
                        @else
                            <div class="row alert alert-warning">
                                <h3 class=" text-center col-md-12">Du har ingen annonser.</h3>
                                <h5 class=" text-center col-md-12">Dine andre annonser kan du finne ved å endre på filteret.</h5>
                            </div>
                        @endif

                        {{--@if(count($ads)<1)--}}
                            {{----}}
                        {{--@endif--}}
                        {{--end repeatation--}}
                       {{-- <div class="pagination">
                        {{ $my_ads->links() }}
                       </div> --}}
                    </div>
                </div>
                 
            </div>
        </div>
    <div class="ajax-load text-center" style="display:none">
        <p><img src="{{ asset('public/images/loaderMore.gif') }}"></p>
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
                page = 1;
                var status = $('input[name=status]:checked').val();
                var ad_type = $('input[name=ad_type]:checked').val();
                var url = $('#url').val();
                $.ajax({
                    url: url+'/'+status+'/'+ad_type,
                    type: "GET",
                    success: function (response) {
                        jQuery.each(response, function(index, item) {
                            if(index != 'html'){
                                if($("span").hasClass( index )){
                                    $('.'+index).text('('+item+')');
                                }
                            }
                        });

                        if(response.html.length > 0) {
                            $('#ads-list').html(response.html);

                            if(status == 'saved'){
                                $('.statistics-button').addClass('d-none');
                                $('.edit-ad-button').text('Fullfør annonsen');
                            }

                            if(status == 'expired'){
                                $('.edit-ad-button').addClass('d-none');
                            }
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

<script type="text/javascript">
	var page = 1;
	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
	        page++;
	        loadMoreData(page);
	    }
	});


	function loadMoreData(page) {
        var status = $('input[name=status]:checked').val();
        var ad_type = $('input[name=ad_type]:checked').val();
        var url = $('#url').val();

        if (isEmpty(status) || isEmpty(ad_type) || isEmpty(url)) {
            full_url = '?page=';
        } else {
            full_url = url + '/' + status + '/' + ad_type + '?page=';
        }
        $.ajax(
            {
                url: full_url + page,
                type: "get",
                beforeSend: function () {
                    $('.ajax-load').show();
                }
            })
            .done(function (data) {
                if (data.html == " ") {
                    $('.ajax-load').html("No more records found");
                    return;
                }
                $('.ajax-load').hide();
                $("#ads-list").append(data.html);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');
            });
    }
</script>
@endsection
