<style>
    #suggestions > div > div.col-md-6 > ul > li > a > span {
        margin-bottom: 0;
    }
</style>

{{--@dd(count($job_fulltime));--}}
<div class="row m-2 search-result-topic" style="margin-bottom: 0 !important;">
    <div class="col-md-3 p1 offset-1">
        @if (count($job_parttime) > 0 || count($job_fulltime) > 0 || count($job_management) >0)
            Jobb
        @endif
    </div>
    <div class="col-md-7">
        <ul class="p-1 list-unstyled">
            @if (count($job_parttime)> 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=part_time')}}"><span class="font-weight-bold"> </span>i deltid
                        ({{count($job_parttime)}})</a></li>
            @endif
            @if(count($job_fulltime) > 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=full_time')}}"><span class="font-weight-bold"> </span>i heltid
                        ({{count($job_fulltime)}})</a></li>
            @endif
            @if(count($job_management) > 0)
                <li><a href="{{url('jobs/search?search='.$search.'&job_type=management')}}"><span class="font-weight-bold"> </span>i ledelse
                        ({{count($job_management)}})</a></li>
            @endif
        </ul>
    </div>
</div>
<div class="row m-2 search-result-topic" style="margin-top: 0px !important;">
    @if((isset($property_for_rent) && count($property_for_rent)>0) ||
        (isset($property_for_sale) && count($property_for_sale)>0) ||
        (isset($property_for_holiday_home_for_Sale) && count($property_for_holiday_home_for_Sale)>0) ||
        (isset($property_realstate_business) && count($property_realstate_business)>0) ||
        (isset($property_flat_wishes) && count($property_flat_wishes)>0) ||
        (isset($commercial_property_for_sale) && count($commercial_property_for_sale)>0) ||
        (isset($commercial_property_for_rent) && count($commercial_property_for_rent)>0) ||
        (isset($commercial_plot) && count($commercial_plot)>0) ||
        (isset($Business_for_sale)) && count($Business_for_sale)>0)

        <div class="col-md-3 p1 offset-1">
            Eiendom
        </div>
        <div class="col-md-7">
            <ul class="p-1 list-unstyled">
                @if (count($property_for_rent)> 0)
                    <li><a href="{{url('property/property-for-rent/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Bolig til leie
                            ({{count($property_for_rent)}})</a></li>
                @endif
                @if(count($property_for_sale) > 0)
                    <li><a href="{{url('property/property-for-sale/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Bolig til salgs
                            ({{count($property_for_sale)}})</a></li>
                @endif
                @if(count($property_for_holiday_home_for_Sale) > 0)
                    <li><a href="{{url('property/holiday-homes-for-sale/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Fritidsbolig til salgs
                            ({{count($property_for_holiday_home_for_Sale)}})</a></li>
                @endif
                @if(count($property_realstate_business) > 0)
                    <li><a href="{{url('property/business-for-sale/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Eiendom Realstate Business
                            ({{count($property_realstate_business)}})</a></li>
                @endif
                @if(count($property_flat_wishes) > 0)
                    <li><a href="{{url('property/flat-wishes-rented/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Bolig ønskes leid
                            ({{count($property_flat_wishes)}})</a></li>
                @endif
                @if(count($commercial_property_for_sale) > 0)
                    <li><a href="{{url('property/commercial-property-for-sale/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Næringseiendom til salgs
                            ({{count($commercial_property_for_sale)}})</a></li>
                @endif
                @if(count($commercial_property_for_rent) > 0)
                    <li><a href="{{url('property/commercial-property-for-rent/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Næringseiendom til leie
                            ({{count($commercial_property_for_rent)}})</a></li>
                @endif
                @if(count($commercial_plot) > 0)
                    <li><a href="{{url('property/commercial-plots/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Næringstomt
                            ({{count($commercial_plot)}})</a></li>
                @endif
                @if(count($Business_for_sale) > 0)
                    <li><a href="{{url('property/business-for-sale/search?search='.$search)}}"><span class="font-weight-bold"> </span>i Bedrifter til salgs
                            ({{count($Business_for_sale)}})</a></li>
                @endif
            </ul>
        </div>
    @endif

</div>
<div class="row go-to-global-search-page">
    <div class="col-md-10 offset-md-1 p-2">
        <a href="{{url('global-search/'.$search)}}" id="all-searches-page">
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
